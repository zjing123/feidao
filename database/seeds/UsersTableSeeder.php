<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin')
            ],
            [
                'name' => 'test',
                'email' => 'test@admin.com',
                'password' => bcrypt('test')
            ],
            [
                'name' => 'test2',
                'email' => 'test2@admin.com',
                'password' => bcrypt('test1')
            ]
        ]);
    }
}
