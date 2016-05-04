<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('team_id')->index();
        $table->string('group_id', 20)->index();
        $table->string('group_source', 20);
        $table->string('name', 60)->index();
        $table->string('description', 255)->nullable();
        $table->string('campus', 40)->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('groups');
    }
}
