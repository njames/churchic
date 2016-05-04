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
            $table->integer('team_id')->index();
            $table->integer('photo_event_id')->unsigned();
            $table->string('first_name', 60);
            $table->string('last_name', 60)->nullable();
            $table->string('email', 120);
            $table->string('mobile', 20)->nullable();
            $table->integer('assigned_number')->unsigned();
            $table->string('photo_original_name',120)->indexed();
            $table->string('photo_path_large',512)->nullable();;
            $table->string('photo_path_small',512)->nullable();;
            $table->string('email_link',512)->nullable();;
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
