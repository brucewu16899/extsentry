<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MigrateSentry extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Artisan::call('migrate', array(
            '--package'=>'cartalyst/sentry'
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Artisan::call('migrate:reset', array(
            '--package'=>'cartalyst/sentry'
        ));
	}

}
