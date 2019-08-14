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
        Schema::create('content', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('owner_id');
            $table->enum('type',['event','activity','board']);

            $table->foreign('owner_id')->references('id')->on('user')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('event', function(Blueprint $table){
            $table->unsignedInteger('id');
            $table->string('event_name',200);
            $table->string('event_description',5000);
            $table->unsignedInteger('img_set_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('id')->references('id')->on('content')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('img_set_id')->references('id')->on('img_set')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('activity', function(Blueprint $table){
            $table->unsignedInteger('id');
            $table->string('activity_name',200);
            $table->string('activity_description',5000);
            $table->unsignedInteger('img_set_id');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('id')->references('id')->on('content')
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
        Schema::dropIfExists('content');
        Schema::dropIfExists('event');
        Schema::dropIfExists('activity');
    }
}
