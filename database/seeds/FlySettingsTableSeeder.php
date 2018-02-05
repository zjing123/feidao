<?php

use Illuminate\Database\Seeder;
use App\Models\FlySetting;

class FlySettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [];
        for ($i = 1; $i <= 40; $i++)
        {
            $settings[] = [
                'number'        => $i,
                'angles'        => 320,
                'gravity'       => 90,
                'power'         => 50,
                'scale'         => 0.8,
                'rx'            => 0,
                'ry'            => 24.10,
                'rz'            => 0,
                'auto_interval' => 5,
                'created_at'    => \Carbon\Carbon::now(),
                'updated_at'    => \Carbon\Carbon::now()
            ];
        }

        FlySetting::insert($settings);
    }
}
