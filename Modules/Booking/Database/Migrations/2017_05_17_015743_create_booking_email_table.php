<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_email', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->integer('member_id');
            $table->integer('status');
            $table->string('c_remark');
            $table->string('voucher_no');
            $table->integer('sender_id');
            $table->string('sender_name');

            $table->timestamps();

            $table->foreign('booking_id')
                  ->references('id')
                  ->on('booking')
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
        Schema::dropIfExists('booking_email');
    }
}
