<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ResponseCode')->nullable();
            $table->string('PayTxnID')->nullable();
            $table->string('ResponseMessage')->nullable();
            $table->string('Paymode')->nullable();
            $table->string('result')->nullable();
            $table->string('gross_amount')->nullable();
            $table->string('net_amount')->nullable();
            $table->string('AuthID')->nullable();
            $table->string('PostDate')->nullable();
            $table->string('TransID')->nullable();
            $table->string('RefID')->nullable();
            $table->string('Order_id')->nullable();
            $table->string('User_Id')->nullable();
            $table->string('Price')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
