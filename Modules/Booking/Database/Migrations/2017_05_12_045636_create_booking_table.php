<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->integer('hotel_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->integer('is_guest');
            $table->string('guest_name');
            $table->string('check_in_name');
            $table->string('guest_email');
            $table->string('guest_nrc');
            $table->string('guest_phone');
            $table->string('guest_type');
            $table->string('booking_ref');
            $table->dateTime('booking_expire');
            $table->integer('price');
            $table->integer('amount');
            $table->integer('discount');
            $table->string('payment_method');
            $table->integer('payment_complete');
            $table->string('language');
            $table->integer('status');
            $table->string('remark');
            $table->dateTime('check_in_date');
            $table->dateTime('check_out_date');
            $table->integer('quantity');
            $table->integer('service_fee');
            $table->longText('note');
            $table->string('bank_name');
            $table->text('bank_remark');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hotel_id')
                  ->references('id')
                  ->on('hotel')
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
        Schema::dropIfExists('booking');
    }
}
