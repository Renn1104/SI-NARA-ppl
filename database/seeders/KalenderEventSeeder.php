<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KalenderEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kalenderevents')->insert([
            [
                'judul_event'     => 'Festival Anggur Nara',
                'deskripsi_event' => 'Nikmati berbagai produk olahan anggur dan pertunjukan seni lokal.',
                'file_event'      => 'festival-anggur.jpg',
                'tanggal_event'   => '2025-05-10',
                'waktu_event'     => '10:00:00',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ],
            [
                'judul_event'     => 'Workshop Budidaya Anggur',
                'deskripsi_event' => 'Belajar langsung cara menanam anggur dari petani profesional.',
                'file_event'      => 'workshop-budidaya.jpg',
                'tanggal_event'   => '2025-05-17',
                'waktu_event'     => '13:00:00',
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now(),
            ]
        ]);
    }
}
