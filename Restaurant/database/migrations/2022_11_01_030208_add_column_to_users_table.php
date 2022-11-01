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
            $table->boolean('can_manage_table')->nullable()->default(false);
            $table->boolean('can_manage_product')->nullable()->default(false);
            $table->boolean('can_manage_category')->nullable()->default(false);
            $table->boolean('can_manage_user')->nullable()->default(false);
            $table->boolean('is_member')->nullable()->default(false);
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
            //
        });
    }
};
