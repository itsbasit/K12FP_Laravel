<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('txn_id');
            $table->string('fundraiser')->nullable();
            $table->string('student')->nullable();
            $table->string('amount_donated');
            $table->string('comission_amount');
            $table->string('amountWithoutComission');
            $table->string('payerName');
            $table->string('payerEmail');
            $table->string('currency');
            $table->string('description');
            $table->enum('payment_method', ['Paypal', 'Stripe']);
            $table->boolean('withdraw_status')->default(0);
            
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
