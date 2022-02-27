<?php

namespace App\Services\Managers;

use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderManager extends AbstractManager
{

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'ORDER';
    }

    public function storeModel(array $data)
    {
        try {
            DB::beginTransaction();

            $order = $this->repository->create($data)->refresh();
            $productIds = Arr::pluck($data['items'], 'product_id');

            $productManager = app()->make(ProductManager::class);
            $products = $productManager->findModels([
                'filter' => [
                    'id' => $productIds
                ]
            ]);

            $products = $products->mapWithKeys(function ($item, $key) {
                return [$item['id'] => ['price' => $item['price'], 'stock' => $item['stock']]];
            });

            $orderItemManager = app()->make(OrderItemManager::class);

            foreach($data['items'] as $item) {
                if($item['quantity'] > $products[$item['product_id']]['stock']) {
                    $message = sprintf('%s_PRODUCT_STOCK_NOT_ENOUGH',$item['product_id']);
                    $error = 'Product Stock Not Enough';

                    goto errorHandle;
                }

                $orderItemData = [
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $products[$item['product_id']]['price'],
                    'total' => $products[$item['product_id']]['price'] * $item['quantity'],
                ];

                $orderItemManager->storeModel($orderItemData);

                $productData = [
                    'stock' => $products[$item['product_id']]['stock'] - $item['quantity']
                ];

                $productManager->updateModel($item['product_id'], $productData);
            }
        } catch (Exception $e) {
            $message = sprintf('%s_NOT_CREATED',Str::upper($this->modelName));
            $error = $e->getMessage();
            
            errorHandle:
            DB::rollBack();
            $this->errorExcptionLog($message, $data, $error);
        }

        DB::commit();

        return $order;
    }

    public function updateModel(int $id, array $data)
    {
        try {
            DB::beginTransaction();

            $order = $this->getModel($id);
            $productIds = Arr::pluck($data['items'], 'product_id');

            $productManager = app()->make(ProductManager::class);
            $products = $productManager->findModels([
                'filter' => [
                    'id' => $productIds
                ]
            ]);

            $products = $products->mapWithKeys(function ($item, $key) {
                return [$item['id'] => ['price' => $item['price'], 'stock' => $item['stock']]];
            });

            $orderItemManager = app()->make(OrderItemManager::class);

            foreach($data['items'] as $item) {
                $orderItemQuantity = 0;
                $orderItem = $order->orderItems->where('product_id',$item['product_id'])->first();
                if($orderItem && $orderItem->quantity == $item['quantity']){
                    continue;
                }

                if($item['quantity'] > $products[$item['product_id']]['stock'] + $orderItemQuantity) {
                    $message = sprintf('%s_PRODUCT_STOCK_NOT_ENOUGH',$item['product_id']);
                    $error = 'Product Stock Not Enough';

                    goto errorHandle;
                }

                if(!$orderItem) {
                    $orderItemData = [
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $products[$item['product_id']]['price'],
                        'total' => $products[$item['product_id']]['price'] * $item['quantity'],
                    ];
                    
                    $orderItemManager->storeModel($orderItemData);

                    $productData = [
                        'stock' => $products[$item['product_id']]['stock'] - $item['quantity']
                    ];
    
                    $productManager->updateModel($item['product_id'], $productData);

                    continue;
                }

                $orderItemData = [
                    'quantity' => $item['quantity'],
                    'total' => $orderItem['unit_price'] * $item['quantity'],
                ];

                $orderItemManager->updateModel($orderItem->id, $orderItemData);

                $productData = [
                    'stock' => $products[$item['product_id']]['stock'] + $orderItemQuantity - $item['quantity']
                ];

                $productManager->updateModel($item['product_id'], $productData);
            }

            foreach($order->orderItems as $orderItem) {
                if(in_array($orderItem->product_id,$productIds)) {
                    continue;
                }

                $productData = [
                    'stock' => $orderItem->product->stock + $orderItem->quantity
                ];

                $orderItemManager->deleteModelById($orderItem->id);

                $productManager->updateModel($orderItem->product_id, $productData);
            }

        } catch (Exception $e) {
            $message = sprintf('%s_NOT_UPDATED',Str::upper($this->modelName));
            $error = $e->getMessage();
            
            errorHandle:
            DB::rollBack();
            $this->errorExcptionLog($message, $data, $error);
        }

        DB::commit();
        
        return true;
    }

    public function deleteModelById(int $id)
    {
        try {
            DB::beginTransaction();

            $order = $this->getModel($id);

            $productManager = app()->make(ProductManager::class);
            $orderItemManager = app()->make(OrderItemManager::class);

            foreach($order->orderItems as $orderItem) {
                $productManager->updateModel($orderItem->product->id,['stock' => $orderItem->product->stock + $orderItem->quantity]);

                $orderItemManager->deleteModelById($orderItem->id);
            }
            
            $query['filter']['id'] = $id;

            $result = $this->repository->delete($query);
        } catch (Exception $e) {
            $message = sprintf('%s_NOT_DELETED',Str::upper($this->modelName));
            $error = $e->getMessage();
            
            DB::rollBack();
            $this->errorExcptionLog($message, $query, $error);
        }

        DB::commit();
        
        return $result;
    }

    public function calculateDiscounts(int $id)
    {
        $order = $this->getModel($id);
        $result = [
            'order_id' => $order->id,
            'discounts' => [],
            'total_discount' => 0,
            'discounted_total' => $order->orderItems->sum('total')
        ];

        $campaignManager = app()->make(CampaignManager::class);
        $orderCampaigns = $campaignManager->allowedOrderCampaigns($order);

        foreach($orderCampaigns as $orderCampaign) {
            $discountAmount = $result['discounted_total']*$orderCampaign['discount_rate']/100;
            $result['total_discount'] +=  $discountAmount;
            $result['discounted_total'] -=  $discountAmount;

            $result['discounts'][] = [
                'discount_reason' => $orderCampaign['reasonn'],
                'discount_amount' => $discountAmount,
                'sub_total' => $result['discounted_total']
            ];
        }

        $orderItemCampaigns = $campaignManager->allowedOrderItemCampaigns($order);

        foreach($orderItemCampaigns as $orderItemCampaign) {
            if($orderItemCampaign['type'] == 3){
                $filteredOrderItems = $order->orderItems->filter(function ($item, $key) use ($orderItemCampaign) {
                    return $item->product->category == $orderItemCampaign['category'];
                })->sortBy('unit_price');

                if($filteredOrderItems->count() >= $orderItemCampaign['min_quantity']) {
                    $filteredOrderItem = $filteredOrderItems->first();

                    $discountAmount = $filteredOrderItem->total*$orderItemCampaign['discount_rate']/100;

                    $result['total_discount'] +=  $discountAmount;
                    $result['discounted_total'] -=  $discountAmount;

                    $result['discounts'][] = [
                        'discount_reason' => $orderItemCampaign['reasonn'],
                        'discount_amount' => $discountAmount,
                        'sub_total' => $result['discounted_total']
                    ];
                    continue;
                }
            }
            if($orderItemCampaign['type'] == 2) {
                $filteredOrderItems = $order->orderItems->filter(function ($item, $key) use ($orderItemCampaign) {
                    return $item->product->category == $orderItemCampaign['category'] && $item->quantity >= $orderItemCampaign['min_quantity'];
                });
                foreach($filteredOrderItems as $filteredOrderItem) {
                    $discountAmount = $filteredOrderItem->unit_price*$orderItemCampaign['discount_quantity'];
                    
                    $result['total_discount'] +=  $discountAmount;
                    $result['discounted_total'] -=  $discountAmount;

                    $result['discounts'][] = [
                        'discount_reason' => $orderItemCampaign['reasonn'],
                        'discount_amount' => $discountAmount,
                        'sub_total' => $result['discounted_total']
                    ];
                }
                
                continue;
            }
        }
        
        return $result;
    }
}
