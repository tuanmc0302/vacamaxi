<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'name') || Schema::hasColumn('users', 'full_name')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name')->nullable()->after('id');
        });

        DB::table('users')->update([
            'full_name' => DB::raw('name'),
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        if (! Schema::hasColumn('users', 'full_name') || Schema::hasColumn('users', 'name')) {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
        });

        DB::table('users')->update([
            'name' => DB::raw('full_name'),
        ]);

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('full_name');
        });
    }
};
