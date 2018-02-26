<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCloumnsToFlySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fly_settings', function (Blueprint $table) {
            $table->float('auto_x')->after('rz');
            $table->float('auto_y')->after('auto_x');
            $table->string('auto_d')->after('auto_y')->default('left');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fly_settings', function (Blueprint $table) {
            //
        });
    }
}
