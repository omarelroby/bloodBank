<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
			$table->string('phone');
			$table->string('email');
			$table->integer('blood_type_id')->unsigned();
			$table->date('d_o_b');
            $table->enum('blood_type',array('o-','o+','B-','B+','A+','A-','AB-','AB+'));
            $table->string('password');
			$table->date('last_donation_date');
			$table->integer('city_id')->unsigned();
			$table->integer('pin_code')->unsigned();
            $table->string('api_token',60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
