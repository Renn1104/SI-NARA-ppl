<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('kecamatan')->nullable();
            $table->string('kabupatenkota')->nullable();
            $table->string('provinsi')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['kecamatan', 'kabupatenkota', 'provinsi']);
        });
    }

};
