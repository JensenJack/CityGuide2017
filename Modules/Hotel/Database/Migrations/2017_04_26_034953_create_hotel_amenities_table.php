<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_amenities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amenity_id')->unsigned();
            $table->integer('hotel_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('amenity_id')
                ->references('id')
                ->on('amenity')
                ->onDelete('cascade');
                     
            $table->foreign('hotel_id')
                ->references('id')
                ->on('hotel')
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
        Schema::dropIfExists('hotel_amenities');
    }
}
