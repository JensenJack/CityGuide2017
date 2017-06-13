<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id')->unsigned();
            $table->integer('room_category_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->integer('local_buy_price');
            $table->integer('local_sell_price');
            $table->integer('foreign_buy_price');
            $table->integer('foreign_sell_price');
            $table->integer('agent_buy_price');
            $table->integer('agent_sell_price');
            $table->integer('quantity');
            $table->integer('minimum_stay');
            $table->integer('max_adults');
            $table->integer('extra_bed');
            $table->integer('extra_bed_charge');
            $table->integer('status');
            $table->string('meta_keyword');
            $table->string('meta_description');

            $table->timestamps();

            $table->foreign('hotel_id')
                ->references('id')
                ->on('hotel')
                ->onDelete('cascade');

            $table->foreign('room_category_id')
                ->references('id')
                ->on('roomcategory')
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
        Schema::dropIfExists('room');
    }
}
