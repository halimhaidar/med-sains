<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->string('id');
            $table->string('lead_id');
            $table->string('contact_address_id')->nullable();
            $table->string('category')->nullable();
            $table->date('closing_date_target')->nullable();
            $table->string('source')->nullable();
            $table->string('description')->nullable();
            $table->string('franco')->nullable();
            $table->integer('validity')->default(0);
            $table->string('delivery_estimation')->nullable();
            $table->string('delivery_condition')->nullable();
            $table->integer('term_of_payment')->default(0);
            $table->string('sales_id')->nullable();
            $table->string('sales_signature')->nullable();
            $table->integer('pdf_show')->default(0);
            $table->integer('pdf_show_decimal')->default(0);
            $table->integer('margin_1')->default(0);
            $table->integer('margin_2')->default(0);
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
        Schema::dropIfExists('quotations');
    }
}
