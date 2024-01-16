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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->text('about')->nullable();
            $table->rememberToken();
            $table->string('photo', 45)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('company_id')->index('fk_user_company1_idx');
            $table->unsignedInteger('rule_id')->index('fk_user_rule1_idx');
            $table->unsignedInteger('employer_id')->nullable()->index('fk_user_employer1_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
