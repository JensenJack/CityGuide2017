<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_amenities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amenity_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->timestamps();

            $table->foreign('amenity_id')
                ->references('id')
                ->on('amenity')
                ->onDelete('cascade');
                     
            $table->foreign('room_id')
                ->references('id')
                ->on('room')
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
        Schema::dropIfExists('room_amenities');
    }
}
