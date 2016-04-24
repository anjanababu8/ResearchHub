<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->text('name');
            $table->dateTime('date_time');
            $table->text('location');
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_posts');
    }
}
