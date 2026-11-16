<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'subtitle')) {
                $table->string('subtitle')->nullable()->after('name_en');
            }
            if (! Schema::hasColumn('products', 'subtitle_en')) {
                $table->string('subtitle_en')->nullable()->after('subtitle');
            }
            if (! Schema::hasColumn('products', 'attributes')) {
                $table->json('attributes')->nullable()->after('gallery');
            }
            if (! Schema::hasColumn('products', 'attributes_en')) {
                $table->json('attributes_en')->nullable()->after('attributes');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'attributes_en')) {
                $table->dropColumn('attributes_en');
            }
            if (Schema::hasColumn('products', 'attributes')) {
                $table->dropColumn('attributes');
            }
            if (Schema::hasColumn('products', 'subtitle_en')) {
                $table->dropColumn('subtitle_en');
            }
            if (Schema::hasColumn('products', 'subtitle')) {
                $table->dropColumn('subtitle');
            }
        });
    }
};
