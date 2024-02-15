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
        Schema::create('operation_out', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 100)->nullable();
            $table->dateTime('initial_time')->nullable();
            $table->dateTime('finish_time')->nullable();
            $table->string('status', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('company_id')->nullable()->index('fk_operation_out_company1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operation_out');
    }
};
