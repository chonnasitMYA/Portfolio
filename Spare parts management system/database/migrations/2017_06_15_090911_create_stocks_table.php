<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('StockID');
            $table->string('DeviceName');
            $table->string('DeviceNo')->nullable();
            $table->string('DeviceSN')->nullable();
            $table->string('DevicePart')->nullable();
            $table->float('Price');
            $table->string('TypePrice');
            $table->integer('DeviceAll');
            $table->string('Type');
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
        Schema::dropIfExists('stocks');
    }
}
