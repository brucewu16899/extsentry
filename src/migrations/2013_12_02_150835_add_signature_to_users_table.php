<?php
/**
 * @created 28.11.13 - 12:19
 * @author stefanriedel
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class  AddSignatureToUsersTable extends Migration {
    public function up() {
        Schema::table('users', function(Blueprint $oTable){
            $oTable->string('signature');
        });
    }


    public function down() {
        Schema::table('users', function(Blueprint $oTable){
            $oTable->dropColumn('signature');
        });
    }
}