<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->string('description_ar')->nullable();
            $table->integer('status')->default(1);
            $table->string('image')->nullable();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('cascade');
    
            $table->text('block')->nullable();
            $table->text('street')->nullable();
            $table->text('building')->nullable();
            $table->longText('address')->nullable();

            $table->integer('province_id')->unsigned()->nullable();
            $table->foreign('province_id')->references('id')
                                         ->on('provinces')
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
        Schema::dropIfExists('agencies');
    }
}
