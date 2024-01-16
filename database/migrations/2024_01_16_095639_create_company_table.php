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
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45)->nullable();
            $table->string('acronym', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('adress', 45)->nullable();
            $table->string('nuit', 45)->nullable();
            $table->string('logo', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('company_id')->nullable()->index('fk_company_company1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
};
