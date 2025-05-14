<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bibits', function (Blueprint $table) {
            $table->id();
            $table->string('judul_bibit');
            $table->string('deskripsi_bibit');
            $table->string('foto_bibit'); // asumsi disimpan path-nya
            $table->integer('jumlah_bibit');
            $table->integer('harga_bibit');
            $table->timestamps();
        });
    }

};
