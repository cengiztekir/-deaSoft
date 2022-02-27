<?php

namespace App\Services\Managers;

use App\Models\Order;
use App\Repositories\CampaignRepository;

class CampaignManager extends AbstractManager
{

    public function __construct(CampaignRepository $repository)
    {
        $this->repository = $repository;
        $this->modelName = 'CAMPAIGN';
    }
    
    public function allowedOrderCampaigns(Order $order)
    {
        $result = [];

        $campaingXPercentOverYByOrderAmount = $this->findXPercentOverYByOrderAmount($order->orderItems->sum('total'));

        if($campaingXPercentOverYByOrderAmount) {
            $result[] = $campaingXPercentOverYByOrderAmount->toArray();
        }

        return $result;
    }
    
    public function allowedOrderItemCampaigns(Order $order)
    {
        $result = [];

        $orderItemCampaigns = $this->findOrderItemCampaigns($order);

        if($orderItemCampaigns) {
            $result = $orderItemCampaigns->toArray();
        }

        return $result;
    }

    public function findXPercentOverYByOrderAmount($amount)
    {
        $campaing = $this->findModels([
            'filter' => [
                'greater_than_min_amount' => $amount,
                'type' => 1
            ]
        ])->first();

        return $campaing;
    }

    public function findOrderItemCampaigns($order)
    {
        $categories = $order->orderItems->map(function ($item, $key) {
            return $item->product->category;
        })->unique()->all();

        $campaings = $this->findModels([
            'filter' => [
                'category' => $categories,
                'type' => [2,3]
            ]
        ]);

        return $campaings;
    }

}
