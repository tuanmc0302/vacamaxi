<?php

namespace database\seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        if (!$admin) return;

        // 1. Tạo danh mục tin tức
        $categories = [
            ['name' => 'Ẩm thực & Steak', 'slug' => 'am-thuc-steak'],
            ['name' => 'Kinh nghiệm chăn nuôi', 'slug' => 'kinh-nghiem-chan-nuoi'],
            ['name' => 'Tin tức VACAMAXI', 'slug' => 'tin-tuc-vaca-maxi'],
        ];

        foreach ($categories as $cat) {
            $category = Category::updateOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'module' => 'news',
                    'is_active' => true
                ]
            );

            // 2. Tạo bài viết mẫu cho từng danh mục
            for ($i = 1; $i <= 4; $i++) {
                $title = $cat['name'] . " - Bài viết số " . $i;
                Post::updateOrCreate(
                    ['slug' => Str::slug($title)],
                    [
                        'category_id' => $category->id,
                        'author_id' => $admin->id,
                        'title' => $title,
                        'image' => '/image/Rectangle ' . ($i + 1) . '.png',
                        'description' => 'Khám phá những bí quyết và thông tin mới nhất về ' . $cat['name'] . '. VACAMAXI cam kết mang đến giá trị tốt nhất cho khách hàng.',
                        'content' => '<p>Đây là nội dung chi tiết của bài viết về ' . $cat['name'] . '. Hệ thống chăn nuôi và chế biến khép kín của VACAMAXI đảm bảo chất lượng từ trang trại đến bàn ăn.</p>',
                        'published_at' => now(),
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
