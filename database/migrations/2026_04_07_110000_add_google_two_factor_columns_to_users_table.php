<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('google_two_factor_secret')->nullable()->after('password');
            $table->boolean('google_two_factor_enabled')->default(false)->after('google_two_factor_secret');
            $table->timestamp('google_two_factor_confirmed_at')->nullable()->after('google_two_factor_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'google_two_factor_secret',
                'google_two_factor_enabled',
                'google_two_factor_confirmed_at',
            ]);
        });
    }
};
