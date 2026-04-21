<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $description = 'VACAMAXI ra đời với khát vọng thay đổi cục diện ngành chăn nuôi Việt Nam. Trong bối cảnh người tiêu dùng ngày càng đòi hỏi cao về chất lượng thịt bò, ngành chăn nuôi trong nước vẫn còn nhiều hạn chế về giống, quy trình và năng suất.';

        SiteSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'VACA MAXI',
                'site_title' => 'VACA MAXI',
                'site_description' => $description,
                'logo' => '/image/logo.png',
                'favicon' => '/favicon.ico',
                'seo_title' => 'VACA MAXI',
                'seo_description' => $description,
                'seo_keywords' => 'vaca maxi, vacamaxi, thịt bò, rượu, nhà hàng, steak grill',
                'seo_image' => '/image/logo.png',
                'address' => '166 Phạm Văn Đồng, P. Đông Ngạc, TP. Hà Nội',
                'phone_wine' => '0983 38 1900 - Hỗ trợ Rượu',
                'phone_beef' => '0988 06 1900 - Hỗ trợ về Bò',
                'email' => 'info@vacamaxi.vn',
                'website_url' => 'https://vacamaxi.vn',
                'zalo_url' => 'https://zalo.me/0983381900',
                'facebook_url' => null,
                'youtube_url' => null,
                'google_map_url' => null,
                'google_map_embed_url' => null,
            ]
        );
    }
}
