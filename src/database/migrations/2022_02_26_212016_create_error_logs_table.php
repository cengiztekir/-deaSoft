<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErrorLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->dropIfExists('error_logs');
        Schema::connection('mongodb')->create('error_logs', function (Blueprint $table) {
            $table->id();
            $table->string('controller_name');
            $table->string('error_key');
            $table->string('user_id');
            $table->string('datas');
            $table->string('result');
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
        Schema::connection('mongodb')->dropIfExists('error_logs');
    }
}
