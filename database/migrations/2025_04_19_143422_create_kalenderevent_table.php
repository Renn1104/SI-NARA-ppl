<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kalenderevents', function (Blueprint $table) {
            $table->id();
            $table->string('judul_event');
            $table->text('deskripsi_event');
            $table->string('file_event');
            $table->date('tanggal_event');
            $table->time('waktu_event');
            $table->timestamps();
        });
        
    }
};
