<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToFlySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fly_settings', function (Blueprint $table) {
            $table->float('hit_pow')->default(5)->after('auto_d');
            $table->float('auto_reward_mul')->default(0.1)->after('hit_pow');
            $table->float('perfect_mul')->default(2)->after('auto_reward_mul');
            $table->float('level_up_pow')->default(1.3)->after('perfect_mul');
            $table->float('buy_demand_mul')->default(25)->after('level_up_pow');
            $table->float('buy_demand_pow')->default(5)->after('buy_demand_mul');
            $table->float('buy_auto_mul')->default(750)->after('buy_demand_pow');
            $table->float('buy_auto_pow')->default(5)->after('buy_auto_mul');
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
