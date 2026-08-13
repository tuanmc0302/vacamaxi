<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('site_name_en')->nullable()->after('site_name');
            $table->string('site_title_en')->nullable()->after('site_title');
            $table->text('site_description_en')->nullable()->after('site_description');
            $table->string('seo_title_en')->nullable()->after('seo_title');
            $table->text('seo_description_en')->nullable()->after('seo_description');
            $table->text('seo_keywords_en')->nullable()->after('seo_keywords');
            $table->string('address_en')->nullable()->after('address');
        });

        Schema::table('frontend_widgets', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('sub_title_en')->nullable()->after('sub_title');
            $table->text('description_en')->nullable()->after('description');
            $table->json('settings_en')->nullable()->after('settings');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->text('short_description_en')->nullable()->after('short_description');
            $table->longText('description_en')->nullable()->after('description');
            $table->string('seo_title_en')->nullable()->after('seo_title');
            $table->text('seo_description_en')->nullable()->after('seo_description');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
            $table->longText('content_en')->nullable()->after('content');
            $table->string('seo_title_en')->nullable()->after('seo_title');
            $table->text('seo_description_en')->nullable()->after('seo_description');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->string('label_en')->nullable()->after('label');
            $table->string('url_en')->nullable()->after('url');
        });

        Schema::table('experts', function (Blueprint $table) {
            $table->string('role_en')->nullable()->after('role');
            $table->text('description_en')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'site_name_en',
                'site_title_en',
                'site_description_en',
                'seo_title_en',
                'seo_description_en',
                'seo_keywords_en',
                'address_en',
            ]);
        });

        Schema::table('frontend_widgets', function (Blueprint $table) {
            $table->dropColumn([
                'title_en',
                'sub_title_en',
                'description_en',
                'settings_en',
            ]);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'name_en',
                'short_description_en',
                'description_en',
                'seo_title_en',
                'seo_description_en',
            ]);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'title_en',
                'description_en',
                'content_en',
                'seo_title_en',
                'seo_description_en',
            ]);
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['label_en', 'url_en']);
        });

        Schema::table('experts', function (Blueprint $table) {
            $table->dropColumn(['role_en', 'description_en']);
        });
    }
};
