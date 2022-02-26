<?php

namespace Database\Seeders;

use App\Models\User as ModelsUser;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'id' => 1,
            'name' => 'Admin',
            'surname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'remember_token' => null,
            'created_at' => now('Europe/Istanbul'),
        ];

        ModelsUser::insert($user);
    }
}
