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
        Schema::create('product_has_stock', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id')->index('fk_product_has_stock_product1_idx');
            $table->unsignedInteger('stock_id')->index('fk_product_has_stock_stock1_idx');
            $table->string('operation_type', 45)->nullable();
            $table->string('quantity', 45)->nullable();
            $table->string('last_qty', 45)->nullable();
            $table->string('atual_qty', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('employer_id')->index('fk_product_has_stock_employer1_idx');
            $table->unsignedInteger('operation_out_id')->nullable()->index('fk_product_has_stock_operation_out1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_has_stock');
    }
};
