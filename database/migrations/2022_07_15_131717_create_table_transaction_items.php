<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();

            // $table->bigInteger('users_id');
            $table->foreignId('users_id')->index('fk_transaction_items_to_users');
            // $table->bigInteger('products_id');
            $table->foreignId('products_id')->index('fk_transaction_items_to_product');
            // $table->bigInteger('transactions_id');
            $table->foreignId('transactions_id')->index('fk_transaction_items_to_transactions');
            $table->bigInteger('quantity');

            $table->softDeletes();
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
        Schema::dropIfExists('transaction_items');
    }
};
