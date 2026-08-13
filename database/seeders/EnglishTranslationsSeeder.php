<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\MenuItem;
use App\Models\Expert;
use App\Models\SiteSetting;
use App\Models\FrontendWidget;
use Illuminate\Database\Seeder;

class EnglishTranslationsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Site Settings
        $setting = SiteSetting::first();
        if ($setting) {
            $setting->update([
                'site_name_en' => 'VACA MAXI',
                'site_title_en' => 'VACA MAXI Dairy Cattle & Wine Ecosystem',
                'site_description_en' => 'VACAMAXI was born with the aspiration to change the landscape of the Vietnamese livestock industry. In the context of consumers demanding high-quality beef, the domestic livestock industry still has many limitations in terms of breeds, processes, and productivity.',
                'seo_title_en' => 'VACA MAXI - Dairy Cattle & Wine Ecosystem',
                'seo_description_en' => 'VACAMAXI was born with the aspiration to change the landscape of the Vietnamese livestock industry.',
                'seo_keywords_en' => 'vaca maxi, vacamaxi, beef, wine, restaurant, steak grill',
                'address_en' => '166 Pham Van Dong Street, Dong Ngac Ward, Hanoi City',
            ]);
        }

        // 2. Categories
        $categories = [
            'ruou' => ['name_en' => 'Wine', 'desc_en' => 'Premium wine selection'],
            'giong-bo-vacamaxi' => ['name_en' => 'Vaca Maxi Cattle Breeds', 'desc_en' => 'High-yield dairy and beef cattle breeds'],
            'thit-bo' => ['name_en' => 'Beef', 'desc_en' => 'Premium quality Vaca Maxi beef'],
            'chuyen-gia' => ['name_en' => 'Experts', 'desc_en' => 'Our genetic and agricultural experts'],
            'nong-nghiep' => ['name_en' => 'Agriculture', 'desc_en' => 'Modern agricultural news'],
            'nganh-thuc-pham-do-uong' => ['name_en' => 'F&B Industry', 'desc_en' => 'Food and beverage industry updates'],
            'tin-doanh-nghiep' => ['name_en' => 'Corporate News', 'desc_en' => 'Company updates and announcements'],
        ];

        foreach ($categories as $slug => $data) {
            Category::where('slug', $slug)->update([
                'name_en' => $data['name_en'],
                'description_en' => $data['desc_en'],
            ]);
        }

        // 3. Products
        $products = [
            'Rượu sâm 369 - 750ml' => [
                'name_en' => 'Ginseng Wine 369 - 750ml',
                'short_en' => 'Ginseng wine line developed by VACAMAXI from grains familiar to Vietnamese people.',
                'desc_en' => 'Ginseng wine line developed by VACAMAXI from grains familiar to Vietnamese people. Fermented and aged using modern technology.',
            ],
            'Rượu trắng Tam Cốc' => [
                'name_en' => 'Tam Coc White Wine',
                'short_en' => 'Traditional white wine with a smooth aftertaste, suitable for Vietnamese cuisine.',
                'desc_en' => 'Traditional white wine with a smooth aftertaste, suitable for Vietnamese cuisine.',
            ],
            'Rượu vang Vaca Reserva' => [
                'name_en' => 'Vaca Reserva Wine',
                'short_en' => 'Premium red wine served with steak and high-class beef dishes.',
                'desc_en' => 'Premium red wine served with steak and high-class beef dishes.',
            ],
            'Rượu thảo mộc Vaca Maxi' => [
                'name_en' => 'Vaca Maxi Herbal Wine',
                'short_en' => 'Balanced with a light herbal aroma, smooth and easy to drink.',
                'desc_en' => 'Balanced with a light herbal aroma, smooth and easy to drink.',
            ],
            'Rượu mận Vaca Maxi' => [
                'name_en' => 'Vaca Maxi Plum Wine',
                'short_en' => 'Mild fruit flavor, suitable for intimate parties.',
                'desc_en' => 'Mild fruit flavor, suitable for intimate parties.',
            ],
            'Thịt Bò Vaca - A' => [
                'name_en' => 'Vaca Beef - A',
                'short_en' => 'Tender meat, even marbling, rich in natural flavors.',
                'desc_en' => 'Tender meat, even marbling, rich in natural flavors.',
            ],
            'Thịt Bò Vaca - I' => [
                'name_en' => 'Vaca Beef - I',
                'short_en' => 'Lean but balanced marbling between sweetness and fat.',
                'desc_en' => 'Lean but balanced marbling between sweetness and fat.',
            ],
            'Thịt Bò Vaca - X' => [
                'name_en' => 'Vaca Beef - X',
                'short_en' => 'Special flavor, outstandingly high lean meat ratio.',
                'desc_en' => 'Special flavor, outstandingly high lean meat ratio.',
            ],
            'Thịt Bò Vaca - B' => [
                'name_en' => 'Vaca Beef - B',
                'short_en' => 'Firm, juicy meat, ideal for industrial processing.',
                'desc_en' => 'Firm, juicy meat, ideal for industrial processing.',
            ],
        ];

        foreach ($products as $name => $data) {
            Product::where('name', $name)->update([
                'name_en' => $data['name_en'],
                'short_description_en' => $data['short_en'],
                'description_en' => $data['desc_en'],
            ]);
        }

        // 4. Menu Items
        $menus = [
            'Trang chủ' => ['label_en' => 'Home', 'url_en' => '/'],
            'Giới thiệu' => ['label_en' => 'About Us', 'url_en' => '/en/about'],
            'Về VACAMAXI' => ['label_en' => 'About VACAMAXI', 'url_en' => '/en/about'],
            'Quy mô phát triển' => ['label_en' => 'Scale of Development', 'url_en' => '/en/about-scale'],
            'Sản phẩm' => ['label_en' => 'Products', 'url_en' => '/en/products'],
            'Giống bò' => ['label_en' => 'Cattle Breeds', 'url_en' => '/en/products/breeds'],
            'Rượu' => ['label_en' => 'Wine', 'url_en' => '/en/products/wine'],
            'Thịt bò' => ['label_en' => 'Beef', 'url_en' => '/en/products/beef'],
            'Dịch vụ - Nhà hàng' => ['label_en' => 'Restaurant', 'url_en' => '/en/restaurant'],
            'Tin Tức' => ['label_en' => 'News', 'url_en' => '/en/news'],
            'Liên hệ' => ['label_en' => 'Contact', 'url_en' => '/en/contact'],
        ];

        foreach ($menus as $label => $data) {
            MenuItem::where('label', $label)->update([
                'label_en' => $data['label_en'],
                'url_en' => $data['url_en'],
            ]);
        }

        // 5. Experts
        $experts = [
            'Hector' => [
                'role_en' => 'Reproduction Genetic Expert',
                'desc_en' => 'Hector has 15 years of experience in genetic breeding and livestock management across Argentina and Vietnam.',
            ],
            'Dr. Lucas' => [
                'role_en' => 'Veterinary Medicine Consultant',
                'desc_en' => 'Over 20 years of dairy cow health advisory in South America.',
            ],
            'Maria' => [
                'role_en' => 'Quality Control Lead',
                'desc_en' => 'Ensures the highest safety and processing standards for beef and milk products.',
            ]
        ];

        foreach ($experts as $name => $data) {
            Expert::where('name', 'like', "%{$name}%")->update([
                'role_en' => $data['role_en'],
                'description_en' => $data['desc_en'],
            ]);
        }

        // 6. Posts
        $posts = Post::all();
        foreach ($posts as $post) {
            $post->update([
                'title_en' => '[EN] ' . $post->title,
                'description_en' => '[EN] ' . $post->description,
                'content_en' => '<!-- English version --><h3>English Version</h3><p>' . strip_tags($post->content) . '</p>',
                'seo_title_en' => $post->seo_title ? '[EN] ' . $post->seo_title : null,
                'seo_description_en' => $post->seo_description ? '[EN] ' . $post->seo_description : null,
            ]);
        }

        // 7. Widgets
        $widgets = FrontendWidget::all();
        foreach ($widgets as $widget) {
            $settings = $widget->settings ?? [];
            $settingsEn = [];

            // Simple translation mappings for widget settings content
            if (isset($settings['hero_subtitle'])) {
                $settingsEn['hero_subtitle'] = 'VACA MAXI CATTLE BREED';
            }
            if (isset($settings['hero_title'])) {
                $settingsEn['hero_title'] = 'VACAMAXI Dairy & Beef Breeding Farm';
            }
            if (isset($settings['hero_desc'])) {
                $settingsEn['hero_desc'] = 'Importing premium cattle genetic sources directly from leading farms.';
            }
            if (isset($settings['button_text'])) {
                $settingsEn['button_text'] = 'See Details';
            }
            if (isset($settings['tabs'])) {
                $settingsEn['tabs'] = array_map(function ($tab) {
                    $tab['title'] = 'Section Detail';
                    $tab['desc'] = 'Modern dairy and agricultural farming operations.';
                    return $tab;
                }, $settings['tabs']);
            }
            if (isset($settings['slides'])) {
                $settingsEn['slides'] = array_map(function ($slide) {
                    $slide['title'] = 'VACAMAXI Premium Selection';
                    $slide['desc'] = 'Imported genetic material from major farms.';
                    return $slide;
                }, $settings['slides']);
            }

            if ($widget->key === 'about_page_values' || str_contains(strtolower($widget->title), 'giá trị cốt lõi')) {
                $settingsEn['image_en'] = '/image/GIÁ TRỊ CỐT LÕI-01 1_en.png';
            }

            $widget->update([
                'title_en' => $widget->title ? $widget->title . ' (EN)' : null,
                'sub_title_en' => $widget->sub_title ? $widget->sub_title . ' (EN)' : null,
                'description_en' => $widget->description ? $widget->description . ' (EN)' : null,
                'settings_en' => $settingsEn,
            ]);
        }
    }
}
