<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'device_user_id' => '1001',
            'name' => 'Ram Sharma',
        ]);

        User::create([
            'device_user_id' => '1002',
            'name' => 'Sita Koirala',
        ]);
    }
}
