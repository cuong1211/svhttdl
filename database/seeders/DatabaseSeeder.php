<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Tổng số bản ghi cần tạo
        $totalRecords = 166799;
        $batchSize = 1000; // Số lượng mỗi lần insert

        // Tạo dữ liệu counter theo batch
        $faker = \Faker\Factory::create();
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 17_1_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1.2 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36'
        ];

        $ips = [
            '127.0.0.1',
            '192.168.1.',
            '10.0.0.',
            '172.16.0.'
        ];

        $recordsCreated = 0;
        while ($recordsCreated < $totalRecords) {
            $batch = [];
            $currentBatchSize = min($batchSize, $totalRecords - $recordsCreated);

            for ($i = 0; $i < $currentBatchSize; $i++) {
                $date = Carbon::now()->subDays(rand(0, 365)); // Dữ liệu trong 1 năm
                $time = sprintf(
                    '%02d:%02d:%02d',
                    rand(0, 23),
                    rand(0, 59),
                    rand(0, 59)
                );

                $ip = $ips[array_rand($ips)] . rand(1, 255);

                $batch[] = [
                    'ip' => $ip,
                    'user_agent' => $userAgents[array_rand($userAgents)],
                    'time' => $time,
                    'date' => $date->format('Y-m-d')
                ];
            }

            // Insert batch
            DB::table('counters')->insert($batch);

            $recordsCreated += $currentBatchSize;
            
            // Hiển thị tiến trình
            $percentage = round(($recordsCreated / $totalRecords) * 100, 2);
            $this->command->info("Đã tạo {$recordsCreated}/{$totalRecords} bản ghi ({$percentage}%)");
        }

        $this->command->info('Hoàn thành seeding database!');
    }
}
