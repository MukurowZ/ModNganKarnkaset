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
        Schema::create('contact_log', function(Blueprint $table){
            $table->increments('id');
            $table->string('topic');
            $table->string('details');
            $table->string('address',200);
            $table->string('email',80);
            $table->string('tel',14);
            $table->timestampTz('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('contact_log');
    }
}
