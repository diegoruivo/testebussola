<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
            $table->dateTime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->date('date_of_birth');
            $table->string('genre');
            $table->string('cell')->nullable();
            $table->string('cover')->nullable();
            $table->boolean('admin')->nullable();
            $table->boolean('student')->nullable();
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
            $table->dropColumn('last_login_at');
            $table->dropColumn('last_login_ip');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('genre');
            $table->dropColumn('cell');
            $table->dropColumn('cover');
            $table->dropColumn('student');
        });
    }
}
