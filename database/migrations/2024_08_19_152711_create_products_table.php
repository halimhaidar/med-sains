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
            $table->id();
            $table->string('name');
            $table->string('catalog')->nullable();
            $table->string('category')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('status')->nullable();
            $table->integer('price')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('safety_stock')->default(0);
            $table->string('attachment')->nullable();
            $table->text('ecatalog_link')->nullable();
            $table->text('description')->nullable();
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
