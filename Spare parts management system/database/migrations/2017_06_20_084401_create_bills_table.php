<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('BillID');
            $table->string('DetailBuy');
            $table->integer('id')->unsigned();
            $table->string('Status');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
             $table->integer('AllowerID')->unsigned();
            $table->foreign('AllowerID')->references('id')->on('users')->onDelete('cascade');            
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
        Schema::dropIfExists('bills');
    }
}
