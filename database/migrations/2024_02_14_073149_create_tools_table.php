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
            $table->string('description')->nullable();
            $table->float('quantity', 10, 0)->nullable();
            $table->string('status')->nullable();
            $table->tinyInteger('active')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('company_id')->index('fk_tools_company1_idx');
            $table->unsignedInteger('tool_group_id')->nullable()->index('fk_tools_tool_group1_idx');
            $table->string('photo')->nullable();
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
