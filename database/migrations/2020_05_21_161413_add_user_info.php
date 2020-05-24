<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('academic_status')->nullable();
            $table->year('academic_status_year')->nullable();

            $table->string('scientific_degree')->nullable();
            $table->year('scientific_degree_year')->nullable();
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
            $table->dropColumn('academic_status');
            $table->dropColumn('academic_status_year');

            $table->dropColumn('scientific_degree');
            $table->dropColumn('scientific_degree_year');
        });
    }
}
