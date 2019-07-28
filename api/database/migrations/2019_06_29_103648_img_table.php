<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_set', function(Blueprint $table){
            $table->increments('id');
            $table->string('name',300);
            $table->unsignedInteger('owner_id');

            $table->foreign('owner_id')->references('id')->on('user')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('img', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('set_id');
            $table->string('path',300);

            $table->foreign('set_id')->references('id')->on('img_set')
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
        Schema::dropIfExists('img_set');
        Schema::dropIfExists('set');
    }
}
