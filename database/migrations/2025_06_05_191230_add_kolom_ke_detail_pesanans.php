<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('detail_pesanans', function (Blueprint $table) {
            $table->string('nama_produk')->after('pesanan_id');
            $table->string('gambar_produk')->nullable()->after('jumlah');
        });
    }

    public function down()
    {
        Schema::table('detail_pesanans', function (Blueprint $table) {
            $table->dropColumn(['nama_produk','gambar_produk']);
        });
    }

};
