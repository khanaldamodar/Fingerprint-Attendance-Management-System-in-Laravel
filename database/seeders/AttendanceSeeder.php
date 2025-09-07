<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\User;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $logs = [
            ['device_user_id' => '1001', 'timestamp' => now()->subMinutes(60), 'status' => 'Check-in'],
            ['device_user_id' => '1002', 'timestamp' => now()->subMinutes(55), 'status' => 'Check-in'],
            ['device_user_id' => '1001', 'timestamp' => now()->subMinutes(10), 'status' => 'Check-out'],
            ['device_user_id' => '1003', 'timestamp' => now()->subMinutes(5), 'status' => 'Check-in'],
        ];

        foreach ($logs as $log) {
            $user = User::where('device_user_id', $log['device_user_id'])->first();
            if ($user) {
                Attendance::create([
                    'user_id' => $user->id,
                    'timestamp' => $log['timestamp'],
                    'status' => $log['status'],
                ]);
            }
        }

    }
}
