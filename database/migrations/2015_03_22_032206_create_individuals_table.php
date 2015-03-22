<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    Schema::create('individuals', function(Blueprint $table) {
      $table->string('id', 10)->primary();
      $table->string('client_id', 30)->index();
      $table->integer('individual_id');
      $table->string('first_name', 60)->nullable();
      $table->string('last_name', 60)->nullable();
      $table->string('middle_name', 60)->nullable();
      $table->string('legal_first_name', 60)->nullable();
      $table->integer('sync_id')->nullable();
      $table->string('other_id', 20)->nullable();
      $table->string('salutation', 5)->nullable();
      $table->string('suffix', 5)->nullable();
      $table->integer('campus_id')->nullable();
      $table->string('campus', 30)->nullable();
      $table->integer('family_id')->nullable();
      $table->string('family_position', 1)->nullable();
      $table->datetime('birthday')->nullable();
      $table->datetime('anniversary')->nullable();
      $table->datetime('deceased')->nullable();
      $table->datetime('membership_date')->nullable();
      $table->datetime('membership_end')->nullable();
      $table->integer('membership_type_id')->nullable();
      $table->string('giving_number', 20)->nullable();
      $table->string('email', 120)->nullable();
      $table->string('mailing_street_address', 60)->nullable();
      $table->string('mailing_city', 60)->nullable();
      $table->string('mailing_state', 3)->nullable();
      $table->string('mailing_zip', 10)->nullable();
      $table->string('mailing_country', 3)->nullable();
      $table->string('home_street_address', 60)->nullable();
      $table->string('home_city', 60)->nullable();
      $table->string('home_state', 3)->nullable();
      $table->string('home_zip', 10)->nullable();
      $table->string('home_country', 3)->nullable();
      $table->string('work_street_address', 60)->nullable();
      $table->string('work_city', 60)->nullable();
      $table->string('work_state', 3)->nullable();
      $table->string('work_zip', 10)->nullable();
      $table->string('work_country', 3)->nullable();
      $table->string('work_title', 60)->nullable();
      $table->string('other_street_address', 60)->nullable();
      $table->string('other_city', 60)->nullable();
      $table->string('other_state', 3)->nullable();
      $table->string('other_zip', 10)->nullable();
      $table->string('other_country', 3)->nullable();
      $table->string('contact_phone', 20)->nullable();
      $table->string('home_phone', 20)->nullable();
      $table->string('work_phone', 20)->nullable();
      $table->string('mobile_phone', 20)->nullable();
      $table->string('allergies', 120)->nullable();
      $table->string('udf_text_1', 255)->nullable();
      $table->string('udf_text_2', 255)->nullable();
      $table->string('udf_text_3', 255)->nullable();
      $table->string('udf_text_4', 255)->nullable();
      $table->string('udf_text_5', 255)->nullable();
      $table->string('udf_text_6', 255)->nullable();
      $table->string('udf_text_7', 255)->nullable();
      $table->string('udf_text_8', 255)->nullable();
      $table->string('udf_text_9', 255)->nullable();
      $table->string('udf_text_10', 255)->nullable();
      $table->string('udf_text_11', 255)->nullable();
      $table->string('udf_text_12', 255)->nullable();
      $table->datetime('udf_date_1')->nullable();
      $table->datetime('udf_date_2')->nullable();
      $table->datetime('udf_date_3')->nullable();
      $table->datetime('udf_date_4')->nullable();
      $table->datetime('udf_date_5')->nullable();
      $table->datetime('udf_date_6')->nullable();
      $table->integer('modifier_id')->nullable();

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
    Schema::drop('individuals');
	}

}
