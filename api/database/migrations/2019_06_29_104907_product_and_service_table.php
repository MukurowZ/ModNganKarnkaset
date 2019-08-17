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
        Schema::create('category', function(Blueprint $table){
            $table->increments('id');
            $table->string('name',200);
            $table->string('THname',200);
            $table->unsignedInteger('head')->nullable();
            $table->tinyInteger('isHead')->default('0');


            $table->foreign('head')->references('id')->on('category')
                ->onDelete('restrict')->onUpdate('cascade');
        });

        Schema::create('product', function(Blueprint $table){
            $table->increments('id');
            $table->string('name',200);
            $table->string('story',2000);
            $table->decimal('price',8,2);
            $table->unsignedInteger('img_set_id');
            $table->unsignedInteger('description');
            $table->string('video',200)->nullable();
            $table->unsignedInteger('type');
            $table->unsignedInteger('owner_id');

            $table->foreign('owner_id')->references('id')->on('user')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('img_set_id')->references('id')->on('img_set')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type')->references('id')->on('category')
                ->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::create('service', function(Blueprint $table){
            $table->increments('id');
            $table->string('name',200);
            $table->string('story',2000);
            $table->decimal('price',8,2);
            $table->unsignedInteger('img_set_id');
            $table->unsignedInteger('description');
            $table->string('video',200)->nullable();
            $table->unsignedInteger('type');
            $table->unsignedInteger('owner_id');

            $table->foreign('owner_id')->references('id')->on('user')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('img_set_id')->references('id')->on('img_set')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type')->references('id')->on('category')
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
        Schema::dropIfExists('category');
        Schema::dropIfExists('product');
        Schema::dropIfExists('service');
    }
}
