<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserPersonalInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->year('hiring_year')->nullable();
            $table->string('pedagogical_title')->default('Немає');
            $table->integer('experience')->default(0);
            $table->string('address', 255)->nullable();
            $table->string('phone', 20)->nullable()->unique();
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
            $table->dropColumn('hiring_year');
            $table->dropColumn('pedagogical_title');
            $table->dropColumn('experience');
            $table->dropColumn('address');
            $table->dropColumn('phone');
        });
    }
}
