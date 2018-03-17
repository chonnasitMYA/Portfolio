<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestdeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestdevice', function (Blueprint $table) {
            $table->increments('RequestdeviceID');
            $table->integer('StockID')->unsigned();
            $table->foreign('StockID')->references('StockID')->on('stocks')->onDelete('cascade');
            $table->string('RequestItemQty');
            $table->integer('BillID')->unsigned();
            $table->foreign('BillID')->references('BillID')->on('bills')->onDelete('cascade');
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
        Schema::dropIfExists('requestdevice');
    }
}
