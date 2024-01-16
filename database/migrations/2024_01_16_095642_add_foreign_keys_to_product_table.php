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
        Schema::table('product', function (Blueprint $table) {
            $table->foreign(['company_id'], 'fk_product_company1')->references(['id'])->on('company')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['product_group_id'], 'fk_product_product_group1')->references(['id'])->on('product_group')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropForeign('fk_product_company1');
            $table->dropForeign('fk_product_product_group1');
        });
    }
};
