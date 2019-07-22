<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId')->unique();
            $table->string('email')->unique();
            $table->string('password',300);
            $table->string('name',50);
            $table->string('lastname',50);
            $table->unsignedInteger('department_id');
            $table->enum('permission',['owner','admin','staff','premium','user']);
            $table->dateTime('updated_at');
            $table->dateTime('created_at');

            $table->foreign('department_id')->references('id')->on('department')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department');
        Schema::dropIfExists('user');
    }
}
