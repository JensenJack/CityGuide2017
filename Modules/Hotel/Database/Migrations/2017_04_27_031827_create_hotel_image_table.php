<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')->unsigned();
            $table->string('image');
            $table->timestamps();

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
        Schema::dropIfExists('hotel_image');
    }
}
