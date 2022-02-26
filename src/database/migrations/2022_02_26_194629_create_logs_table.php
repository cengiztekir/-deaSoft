<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
    * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->dropIfExists('logs');
        Schema::connection('mongodb')->create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('controller_name');
            $table->string('user_id');
            $table->string('datas');
            $table->string('filters')->nullable();
            $table->string('result')->nullable();
            $table->string('model');
            $table->string('ip');
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
        Schema::connection('mongodb')->dropIfExists('logs');
    }
}