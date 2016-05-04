<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('group_participants', function (Blueprint $table) {

        $table->increments('id');
        $table->integer('team_id')->index();
        $table->integer('group_id')->index();
        $table->integer('participant_id')->index();
        $table->string('first_name', 60)->nullable();
        $table->string('last_name', 60)->nullable();
        $table->string('full_name', 120)->nullable();
        $table->string('email', 120)->nullable();
        $table->string('mobile_phone', 16)->nullable();
        $table->boolean('receive_email_from_church')->default(false);
        $table->boolean('receive_email_from_group')->default(false);
        $table->boolean('receive_sms_from_group')->default(false);
        $table->dateTime('date_joined')->nullable();
        $table->string('mc_euid', 10)->nullable();
        $table->string('mc_leid', 10)->nullable();
        $table->string('last_updated_by', 20)->nullable();
        $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('group_participants');
    }
}
