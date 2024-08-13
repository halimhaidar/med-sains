<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('handle_by');
            $table->string('category_id')->nullable();
            $table->string('category_name')->nullable();
            $table->text('image_brand')->nullable();
            $table->text('description')->nullable();
            $table->string('vendor_id')->nullable();
            $table->string('vendor_name')->nullable();
            $table->decimal('sq_target', 15, 2)->default(0);
            $table->decimal('so_target', 15, 2)->default(0);
            $table->decimal('sales_target', 15, 2)->default(0);
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
        Schema::dropIfExists('brands');
    }
}
