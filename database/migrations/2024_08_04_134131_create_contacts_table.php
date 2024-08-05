<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('salutation')->nullable();
            $table->string('name');
            $table->string('academic_degree')->nullable();
            $table->string('job_title')->nullable();
            $table->string('gender');
            $table->unsignedBigInteger('company_id');
            $table->string('company');
            $table->string('email');
            $table->string('phone');
            $table->string('segment');
            $table->string('sub_segment')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->text('address');
            $table->string('post_code')->nullable();
            $table->string('pic');
            $table->string('created_by');
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
        Schema::dropIfExists('contacts');
    }
}
