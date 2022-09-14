<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_receipts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            
            $table->unsignedBigInteger('receipt_id');
            $table->foreign('receipt_id')->references('id')->on('receipts');

            $table->unsignedBigInteger('amount');

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
        Schema::dropIfExists('items_receipts');
    }
}
