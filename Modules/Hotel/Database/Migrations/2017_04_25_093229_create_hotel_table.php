<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel', function (Blueprint $table) {
          $table->increments('id');
            $table->integer('city_id')->unsigned();
            $table->integer('hotel_category_id')->unsigned();
            $table->string('name');
            $table->string('address');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('logo');
            $table->string('phone');
            $table->string('email');
            $table->string('description');
            $table->integer('class');
            $table->string('meta_keyword');
            $table->string('meta_description');
            $table->timestamps();

            $table->foreign('city_id')
                ->references('id')
                ->on('city')
                ->onDelete('cascade');

            $table->foreign('hotel_category_id')
                ->references('id')
                ->on('hotelcategory')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel');
    }
}
