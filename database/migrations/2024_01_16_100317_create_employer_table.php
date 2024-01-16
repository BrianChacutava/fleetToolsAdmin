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
        Schema::create('employer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 45)->nullable();
            $table->string('last_name', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('identification_num', 45)->nullable();
            $table->string('identification_type', 45)->nullable();
            $table->string('adress', 45)->nullable();
            $table->string('phone1', 45)->nullable();
            $table->string('phone2', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('category_id')->index('fk_employer_category1_idx');
            $table->unsignedInteger('company_id')->index('fk_employer_company1_idx');
            $table->string('bage_number', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employer');
    }
};
