<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'price_text')) {
                $table->string('price_text')->nullable()->after('subtitle_en');
            }
            if (! Schema::hasColumn('products', 'price_text_en')) {
                $table->string('price_text_en')->nullable()->after('price_text');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'price_text_en')) {
                $table->dropColumn('price_text_en');
            }
            if (Schema::hasColumn('products', 'price_text')) {
                $table->dropColumn('price_text');
            }
        });
    }
};
