<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [ 
                'id' => '1',
                'name' => 'Admin Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('adminadmin'),
            ],
        ]);
    }
}
