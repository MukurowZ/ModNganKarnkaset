<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('prefix',3);
        });

        Schema::create('contact_log', function(Blueprint $table){
            $table->increments('id');
            $table->string('topic');
            $table->string('details');
            $table->string('address',200);
            $table->string('email',80);
            $table->unsignedInteger('country_id');
            $table->string('tel',14);
            $table->dateTime('updated_at');
            $table->dateTime('created_at');

            $table->foreign('country_id')->references('id')->on('country')
                ->onDelete('restrict')->onUpdate('restrict');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_log');
        Schema::dropIfExists('country');
    }
}
