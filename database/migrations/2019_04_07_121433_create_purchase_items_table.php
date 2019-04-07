<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invoice_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->integer('quantity')->default(0);
            $table->float('price')->default(0.00);
            $table->integer('tax')->default(0);
        });

        Schema::table('purchase_items', function($table) {
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_items');
    }
}
