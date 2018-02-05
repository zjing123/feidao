<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fly_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('number');
            $table->float('angles');
            $table->float('gravity');
            $table->float('power');
            $table->float('scale');
            $table->float('rx');
            $table->float('ry');
            $table->float('rz');
            $table->float('auto_interval');
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
        Schema::dropIfExists('fly_settings');
    }
}
