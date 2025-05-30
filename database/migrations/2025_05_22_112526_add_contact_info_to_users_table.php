<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactInfoToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->after('email');       // setelah kolom email
            $table->string('address')->nullable()->after('phone');          // setelah phone
            $table->string('postal_code', 10)->nullable()->after('address'); // setelah address
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'postal_code']);
        });
    }
}
