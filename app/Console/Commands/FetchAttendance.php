<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Attendance;
use CodingLibs\ZktecoPhp\Libs\ZKTeco;

class FetchAttendance extends Command
{
    protected $signature = 'attendance:fetch';
    protected $description = 'Fetch users and attendance logs from ZKTeco device';

    public function handle()
    {
        $deviceIp = '192.168.1.201';
        $port = 4370;

        $zk = new ZKTeco($deviceIp, $port);

        try {
            if (!$zk->connect()) {
                $this->error("❌ Unable to connect to ZKTeco device at {$deviceIp}:{$port}");
                return;
            }

            $zk->disableDevice();

            /**
             * 🔹 Step 1: Sync Users
             */
            $deviceUsers = $zk->getUsers();
            dd($deviceUsers[1]);
            $this->info("✅ Found " . count($deviceUsers) . " users on device.");

            foreach ($deviceUsers as $du) {
                $deviceUserId = $du['uid'] ?? $du['id'] ?? null;

                if (!$deviceUserId) {
                    $this->warn("⚠️ Skipped a device user with no ID");
                    continue;
                }

                $user = User::updateOrCreate(
                    ['device_user_id' => $deviceUserId],
                    [
                        'name' => $du['name'] ?? 'Unknown User',
                        'phone' => $du['card'] ?? null,
                        'department' => null,
                    ]
                );

                $this->line("👤 Synced user: {$user->name} (device_user_id: {$deviceUserId})");
            }

            /**
             * 🔹 Step 2: Sync Attendance Logs
             */
            $attendances = $zk->getAttendances();
            dd($attendances[0]);

            if (empty($attendances)) {
                $this->warn("⚠️ No attendance logs found.");
            } else {
                $this->info("✅ Found " . count($attendances) . " attendance records.");

foreach ($attendances as $log) {
    $deviceUserId = $log['uid'] ?? $log['user_id'] ?? null;
    $timestamp    = $log['record_time'] ?? null;
    $status       = $log['state'] ?? null;

    if (!$deviceUserId || !$timestamp) {
        $this->warn("⚠️ Skipped log: missing user_id or timestamp");
        continue;
    }

    $user = User::where('device_user_id', $deviceUserId)->first();

    if ($user) {
        Attendance::updateOrCreate(
            [
                'user_id'   => $user->id,
                'timestamp' => $timestamp,
            ],
            [
                'status' => $status,
            ]
        );

        $this->line("📌 Attendance saved for {$user->name} at {$timestamp}");
    } else {
        $this->warn("⚠️ User with device_user_id {$deviceUserId} not found in DB");
    }
}

                $this->info("🎉 Attendance fetched successfully.");
            }

            $zk->enableDevice();
            $zk->disconnect();

        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
        }
    }
}
