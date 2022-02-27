<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('reasonn',500);
            $table->integer('category')->nullable();
            $table->integer('min_quantity')->nullable();
            $table->integer('discount_quantity')->nullable();
            $table->decimal('min_amount',10,2)->nullable();
            $table->decimal('discount_rate',5,2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
