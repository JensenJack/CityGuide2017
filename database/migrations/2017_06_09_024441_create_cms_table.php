<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('cms'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('page');
            $table->longText('meta_tags');
            $table->longText('keyword');
            $table->string('title');
            $table->longText('content');
            $table->string('mm_title');
            $table->longText('mm_content');
            $table->softDeletes();
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
        //
    }
}
