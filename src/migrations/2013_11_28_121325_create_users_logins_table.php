<?php
/**
 * @created 28.11.13 - 12:19
 * @author stefanriedel
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class  CreateUsersLoginsTable extends Migration {
    public function up() {
        Schema::create('logins', function(Blueprint $oTable){
            $oTable->increments('id');
            $oTable->unsignedInteger('user_id');
            $oTable->string('ip');
            $oTable->string('session_id');
            $oTable->timestamp('login_at');
            $oTable->timestamp('logout_at')->nullable();
            $oTable->timestamps();
            $oTable->engine = 'InnoDB';
        });
    }

    public function down() {
        Schema::dropIfExists('logins');
    }
}