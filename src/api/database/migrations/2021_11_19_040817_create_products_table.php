<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('name')->nullable();
            $table->text('desc')->nullable();
            $table->integer('inventory_id')->unsigned();
            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->decimal('price', 5, 2)->nullable();
            $table->integer('discount_id')->unsigned();
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->integer('rate_id')->unsigned();
            $table->foreign('rate_id')->references('id')->on('rates');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags');
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
        Schema::dropIfExists('products');
    }
}
