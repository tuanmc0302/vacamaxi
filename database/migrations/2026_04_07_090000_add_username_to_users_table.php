<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('full_name');
        });

        DB::table('users')->orderBy('id')->get()->each(function (object $user): void {
            $baseUsername = Str::slug(
                $user->full_name ?: Str::before((string) $user->email, '@'),
                separator: ''
            );

            if ($baseUsername === '') {
                $baseUsername = 'user'.$user->id;
            }

            $username = $baseUsername;
            $counter = 1;

            while (
                DB::table('users')
                    ->where('username', $username)
                    ->where('id', '!=', $user->id)
                    ->exists()
            ) {
                $username = $baseUsername.$counter;
                $counter++;
            }

            DB::table('users')
                ->where('id', $user->id)
                ->update(['username' => $username]);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropColumn('username');
        });
    }
};
