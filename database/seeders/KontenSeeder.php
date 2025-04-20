<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Konten;

class KontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Konten::create([
            'judul_konten'     => 'Tips Menjaga Kesehatan Mental',
            'deskripsi_konten' => 'Berikut ini adalah beberapa tips untuk menjaga kesehatan mental di era digital.',
            'file_konten'      => 'kesehatan-mental.pdf',
            'tanggal_unggah'   => now(),
        ]);

        Konten::create([
            'judul_konten'     => 'Panduan Pola Makan Sehat',
            'deskripsi_konten' => 'Pola makan sehat penting untuk menjaga energi dan imunitas tubuh.',
            'file_konten'      => 'pola-makan.pdf',
            'tanggal_unggah'   => now(),
        ]);

        Konten::create([
            'judul_konten'     => 'Latihan Fisik di Rumah',
            'deskripsi_konten' => 'Latihan ringan yang bisa kamu lakukan sendiri di rumah tanpa alat.',
            'file_konten'      => 'latihan-rumah.pdf',
            'tanggal_unggah'   => now(),
        ]);
    }
}
