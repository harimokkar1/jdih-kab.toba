<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorSeeder extends Seeder
{
    /**
     * Jalankan seeder data statistik kunjungan publik portal JDIH.
     */
    public function run(): void
    {
        Visitor::truncate();

        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4 Safari/605.1.15',
            'Mozilla/5.0 (Linux; Android 14; SM-S918B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Mobile Safari/537.36',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/127.0.0.0 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (X11; Linux x86_64; rv:128.0) Gecko/20100101 Firefox/128.0',
        ];

        $now = Carbon::now();
        $records = [];
        $ipCounter = 1;

        // Buat statistik kunjungan 30 hari ke belakang
        for ($daysAgo = 29; $daysAgo >= 0; $daysAgo--) {
            $date = $now->copy()->subDays($daysAgo);
            $dateString = $date->toDateString();

            // Rata-rata 60 - 120 kunjungan per hari
            $dailyCount = rand(65, 115);
            if ($daysAgo === 0) {
                // Hari ini
                $dailyCount = 48;
            } elseif ($daysAgo === 1) {
                // Kemarin
                $dailyCount = 92;
            }

            for ($i = 0; $i < $dailyCount; $i++) {
                $subMinutes = ($daysAgo === 0) ? rand(2, 600) : rand(10, 1400);
                $activityTime = $date->copy()->startOfDay()->addMinutes($subMinutes);

                // Khusus untuk hari ini, pastikan beberapa pengunjung aktif di 10 menit terakhir (online)
                if ($daysAgo === 0 && $i < 6) {
                    $activityTime = $now->copy()->subMinutes(rand(1, 10));
                }

                $ip = "180.244." . (($ipCounter % 250) + 1) . "." . (($i % 250) + 1);
                $ua = $userAgents[array_rand($userAgents)];

                $records[] = [
                    'ip_address' => $ip,
                    'user_agent' => $ua,
                    'visited_date' => $dateString,
                    'last_activity' => $activityTime,
                    'created_at' => $activityTime,
                    'updated_at' => $activityTime,
                ];

                $ipCounter++;

                // Chunk insert jika batch besar
                if (count($records) >= 500) {
                    DB::table('visitors')->insert($records);
                    $records = [];
                }
            }
        }

        if (!empty($records)) {
            DB::table('visitors')->insert($records);
        }
    }
}

