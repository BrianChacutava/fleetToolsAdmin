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
        Schema::table('tools_has_stock', function (Blueprint $table) {
            $table->foreign(['operation_out_id'], 'fk_tools_has_stock_operation_out1')->references(['id'])->on('operation_out')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tools_id'], 'fk_tools_has_stock_tools1')->references(['id'])->on('tools')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['employer_id'], 'fk_tools_has_stock_employer1')->references(['id'])->on('employer')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['stock_id'], 'fk_tools_has_stock_stock1')->references(['id'])->on('stock')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tools_has_stock', function (Blueprint $table) {
            $table->dropForeign('fk_tools_has_stock_operation_out1');
            $table->dropForeign('fk_tools_has_stock_tools1');
            $table->dropForeign('fk_tools_has_stock_employer1');
            $table->dropForeign('fk_tools_has_stock_stock1');
        });
    }
};
