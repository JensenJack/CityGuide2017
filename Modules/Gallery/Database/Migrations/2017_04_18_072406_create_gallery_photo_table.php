<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryPhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries_photo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();
            $table->string('image');
            $table->timestamps();

            // $table->foreign('gallery_id')
            //     ->references('id')
            //     ->on('galleries')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galleries_photo');
    }
}
