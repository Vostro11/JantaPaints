<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration {
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up() {
		Schema::create('colors', function (Blueprint $table) {
			$table->increments('id');
			$table->string('sno');
			$table->string('shade_name');
			$table->string('shade_code');
			$table->string('rgb');
			$table->string('type');
			$table->enum('status',['Active','Inactive']);
			$table->timestamps();
		});
	}
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function down() {
		Schema::drop('colors');
	}
}