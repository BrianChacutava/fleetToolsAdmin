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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign(['company_id'], 'fk_user_company1')->references(['id'])->on('company')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['rule_id'], 'fk_user_rule1')->references(['id'])->on('rule')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['employer_id'], 'fk_user_employer1')->references(['id'])->on('employer')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('fk_user_company1');
            $table->dropForeign('fk_user_rule1');
            $table->dropForeign('fk_user_employer1');
        });
    }
};
