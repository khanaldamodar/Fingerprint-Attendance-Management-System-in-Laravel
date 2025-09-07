<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Device::create(([
            'device_name' => 'Device 1',
            'ip_address' => '192.168.1.101'
        ]));

         Device::create(([
            'device_name' => 'Device 2',
            'ip_address' => '192.168.1.201'
        ]));
    }
}
