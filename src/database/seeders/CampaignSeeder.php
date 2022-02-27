<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Toplam 1000TL ve üzerinde alışveriş yapan bir müşteri, siparişin tamamından %10 indirim kazanır.
        Campaign::create([
            'type' => 1,
            'reasonn' => '10_PERCENT_OVER_1000',
            'min_amount' => 1000,
            'discount_rate' => 10
        ]);

        //2 ID'li kategoriye ait bir üründen 6 adet satın alındığında, bir tanesi ücretsiz olarak verilir.
        Campaign::create([
            'type' => 2,
            'reasonn' => 'BUY_6_GET_1',
            'category' => 2,
            'min_quantity' => 6,
            'discount_quantity' => 1
        ]);

        // 1 ID'li kategoriden iki veya daha fazla ürün satın alındığında, en ucuz ürüne %20 indirim yapılır.
        Campaign::create([
            'type' => 3,
            'reasonn' => 'BUY_DIFFERENT_2_PRODUCT_SAME_CATEGORY_GET_20_PERCENT_FOR_CHEAP_PRODUCT',
            'category' => 1,
            'min_quantity' => 2,
            'discount_rate' => 20
        ]);
    }
}