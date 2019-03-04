<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_ar')->nullable();

            $table->string('year')->nullable();
            $table->double('price', 8, 3);
            $table->integer('qty')->default(1);            

            $table->integer('status')->default(1);
            $table->string('image')->nullable();


            $table->integer('body_color')->unsigned()->nullable();
            $table->foreign('body_color')->references('id')
                                         ->on('colors')
                                         ->onUpdate('cascade')
                                         ->onDelete('cascade');

            $table->integer('interior_color')->unsigned()->nullable();
            $table->foreign('interior_color')->references('id')
                                         ->on('colors')
                                         ->onUpdate('cascade')
                                         ->onDelete('cascade');

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')
                                         ->on('categories')
                                         ->onUpdate('cascade')
                                         ->onDelete('cascade');

            $table->integer('condition_id')->unsigned()->nullable();
            $table->foreign('condition_id')->references('id')
                                         ->on('conditions')
                                         ->onUpdate('cascade')
                                         ->onDelete('cascade');

            $table->integer('fuel_id')->unsigned()->nullable();
            $table->foreign('fuel_id')->references('id')
                                         ->on('fuels')
                                         ->onUpdate('cascade')
                                         ->onDelete('cascade');

            $table->integer('model_id')->unsigned()->nullable();
            $table->foreign('model_id')->references('id')
                                         ->on('models')
                                         ->onUpdate('cascade')
                                         ->onDelete('cascade');

            $table->integer('transmission_id')->unsigned()->nullable();
            $table->foreign('transmission_id')->references('id')
                                         ->on('transmissions')
                                         ->onUpdate('cascade')
                                         ->onDelete('cascade');


            $table->integer('agency_id')->unsigned()->nullable();
            $table->foreign('agency_id')->references('id')
                                         ->on('agencies')
                                         ->onUpdate('cascade')
                                         ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
