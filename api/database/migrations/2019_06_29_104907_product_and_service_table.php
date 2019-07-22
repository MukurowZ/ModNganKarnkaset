<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductAndServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function(Blueprint $table){
            $table->increments('id');
            $table->string('name',200);
            $table->unsignedInteger('head')->nullable();;

            $table->foreign('head')->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('products', function(Blueprint $table){
            $table->increments('id');
            $table->string('name',200);
            $table->string('story',2000);
            $table->decimal('price',8,2);
            $table->unsignedInteger('img_set_id');
            $table->unsignedInteger('description');
            $table->string('video',200)->nullable();
            $table->unsignedInteger('type');
            $table->unsignedInteger('owner_id');

            $table->foreign('owner_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('img_set_id')->references('id')->on('img_set')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type')->references('id')->on('categories')
                ->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::create('services', function(Blueprint $table){
            $table->increments('id');
            $table->string('name',200);
            $table->string('story',2000);
            $table->decimal('price',8,2);
            $table->unsignedInteger('img_set_id');
            $table->unsignedInteger('description');
            $table->string('video',200)->nullable();
            $table->unsignedInteger('type');
            $table->unsignedInteger('owner_id');

            $table->foreign('owner_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('img_set_id')->references('id')->on('img_set')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type')->references('id')->on('categories')
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('services');
    }
}
