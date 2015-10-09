<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoEventParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_event_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_id', 30)->index();
            $table->integer('photo_event_id')->unsigned();
            $table->string('name', 60);
            $table->string('email', 120);
            $table->integer('assigned_number')->unsigned();
            $table->string('orginal_name',20)->indexed();
            $table->string('path_photo_large',512);
            $table->string('path_photo_small',512);
            $table->timestamps();

            $table->foreign('photo_event_id')->references('id')->on('photo_events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('photo_event_participants');
    }
}
