<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Content extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('owner_id');
            $table->enum('type',['event','activity','board']);

            $table->foreign('owner_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('events', function(Blueprint $table){
            $table->unsignedInteger('id');
            $table->string('event_name',200);
            $table->string('event_description',5000);
            $table->unsignedInteger('img_set_id');
            $table->timestamp('created_on');

            $table->foreign('id')->references('id')->on('contents')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('img_set_id')->references('id')->on('img_set')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('activities', function(Blueprint $table){
            $table->unsignedInteger('id');
            $table->string('activity_name',200);
            $table->string('activity_description',5000);
            $table->unsignedInteger('img_set_id');
            $table->timestamp('created_on');

            $table->foreign('id')->references('id')->on('contents')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('img_set_id')->references('id')->on('img_set')
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
        //
        Schema::dropIfExists('contents');
        Schema::dropIfExists('events');
        Schema::dropIfExists('activities');
    }
}
