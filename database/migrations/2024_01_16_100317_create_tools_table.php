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
        Schema::create('tools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45)->nullable();
            $table->string('make', 45)->nullable();
            $table->string('model', 45)->nullable();
            $table->string('reference_num', 45)->nullable();
            $table->string('description', 45)->nullable();
            $table->string('quantity', 45)->nullable();
            $table->string('status', 45)->nullable();
            $table->string('active', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('company_id')->index('fk_tools_company1_idx');
            $table->unsignedInteger('tool_group_id')->nullable()->index('fk_tools_tool_group1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools');
    }
};
