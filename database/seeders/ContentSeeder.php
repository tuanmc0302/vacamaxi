<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $productCategories = [
            ['name' => 'Rượu', 'slug' => 'ruou', 'sort_order' => 1],
            ['name' => 'Giống bò Vaca Maxi', 'slug' => 'giong-bo-vacamaxi', 'sort_order' => 2],
            ['name' => 'Thịt bò', 'slug' => 'thit-bo', 'sort_order' => 3],
            ['name' => 'Chuyên gia', 'slug' => 'chuyen-gia', 'sort_order' => 4],
        ];

        foreach ($productCategories as $category) {
            Category::query()->updateOrCreate(
                ['module' => Category::MODULE_PRODUCT, 'slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => null,
                    'sort_order' => $category['sort_order'],
                    'is_active' => true,
                ],
            );
        }

        $newsCategories = ['Nông nghiệp', 'Ngành thực phẩm & đồ uống', 'Tin doanh nghiệp'];

        foreach ($newsCategories as $index => $name) {
            Category::query()->updateOrCreate(
                ['module' => Category::MODULE_NEWS, 'slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => null,
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ],
            );
        }

        $productCategoryMap = Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->get()
            ->keyBy('slug');

        $products = [
            'ruou' => [
                [
                    'name' => 'Rượu sâm 369 - 750ml',
                    'image' => 'image/Rectangle 4.png',
                    'short' => 'Dòng rượu sâm do VACAMAXI phát triển từ ngũ cốc quen thuộc với người Việt.',
                ],
                [
                    'name' => 'Rượu trắng Tam Cốc',
                    'image' => 'image/Rectangle 3.png',
                    'short' => 'Rượu trắng truyền thống, hậu vị mềm và phù hợp ẩm thực Việt.',
                ],
                [
                    'name' => 'Rượu vang Vaca Reserva',
                    'image' => 'image/Rectangle 5.png',
                    'short' => 'Rượu dùng kèm steak và các món bò cao cấp.',
                ],
                [
                    'name' => 'Rượu thảo mộc Vaca Maxi',
                    'image' => 'image/Rectangle 4.png',
                    'short' => 'Cân bằng hương thảo mộc nhẹ, vị êm và dễ uống.',
                ],
                [
                    'name' => 'Rượu mận Vaca Maxi',
                    'image' => 'image/Rectangle 3.png',
                    'short' => 'Hương trái cây dịu, phù hợp dùng trong các bữa tiệc thân mật.',
                ],
            ],
            'thit-bo' => [
                [
                    'name' => 'Thịt Bò Vaca - A',
                    'image' => 'image/Rectangle 2.png',
                    'short' => 'Thịt mềm, vân mỡ đều, giàu hương vị tự nhiên.',
                ],
                [
                    'name' => 'Thịt Bò Vaca - I',
                    'image' => 'image/Rectangle 3.png',
                    'short' => 'Nạc nhưng vẫn có vân mỡ cân bằng giữa độ ngọt và độ béo.',
                ],
                [
                    'name' => 'Thịt Bò Vaca - X',
                    'image' => 'image/Rectangle 4.png',
                    'short' => 'Hương vị đặc biệt, nạc cao vượt trội.',
                ],
                [
                    'name' => 'Thịt Bò Vaca - B',
                    'image' => 'image/Rectangle 5.png',
                    'short' => 'Thịt chắc, mọng nước, lý tưởng cho chế biến công nghiệp.',
                ],
                [
                    'name' => 'Steak Vaca Maxi Prime',
                    'image' => 'image/Rectangle 11.png',
                    'short' => 'Phần steak tuyển chọn cho nhà hàng cao cấp.',
                ],
            ],
            'giong-bo-vacamaxi' => [
                [
                    'name' => 'Vaca - A',
                    'image' => 'image/Rectangle 2.png',
                    'short' => 'Lai tạo từ giống nền Angus, nổi bật về độ mềm thịt và hiệu suất thương phẩm.',
                ],
                [
                    'name' => 'Vaca - I',
                    'image' => 'image/Rectangle 3.png',
                    'short' => 'Dòng bò cân bằng giữa nạc và mỡ, phù hợp định hướng thương mại quy mô lớn.',
                ],
                [
                    'name' => 'Vaca - X',
                    'image' => 'image/Rectangle 4.png',
                    'short' => 'Dòng giống có năng suất ổn định và khả năng thích nghi cao.',
                ],
                [
                    'name' => 'Vaca - B',
                    'image' => 'image/Rectangle 5.png',
                    'short' => 'Lai tạo theo hướng sức mạnh cân bằng giữa tăng trọng và chất lượng thịt.',
                ],
            ],
            'chuyen-gia' => [
                [
                    'name' => 'Chuyên gia dinh dưỡng Argentina',
                    'image' => 'image/Rectangle 2.png',
                    'short' => 'Tư vấn khẩu phần và tiêu chuẩn dinh dưỡng cho đàn bò.',
                ],
                [
                    'name' => 'Chuyên gia giống bò Vaca A',
                    'image' => 'image/Rectangle 11.png',
                    'short' => 'Phụ trách chọn lọc giống nền Angus và đánh giá chất lượng thịt.',
                ],
                [
                    'name' => 'Chuyên gia giống bò Vaca I',
                    'image' => 'image/Rectangle 2.png',
                    'short' => 'Phụ trách lai tạo và phát triển đặc tính cân bằng nạc mỡ.',
                ],
                [
                    'name' => 'Chuyên gia giống bò Vaca X',
                    'image' => 'image/Rectangle 3.png',
                    'short' => 'Định hướng phát triển dòng bò nạc cao, năng suất ổn định.',
                ],
                [
                    'name' => 'Chuyên gia vận hành chuỗi Vaca Maxi',
                    'image' => 'image/Rectangle 5.png',
                    'short' => 'Tư vấn tiêu chuẩn vận hành trang trại, chế biến và nhà hàng.',
                ],
            ],
        ];

        $sortOrder = 1;

        foreach ($products as $categorySlug => $items) {
            $category = $productCategoryMap->get($categorySlug);

            if (! $category) {
                continue;
            }

            foreach ($items as $item) {
                Product::query()->updateOrCreate(
                    ['slug' => Str::slug($item['name'])],
                    [
                        'category_id' => $category->id,
                        'name' => $item['name'],
                        'image' => $item['image'],
                        'short_description' => $item['short'],
                        'description' => $item['short'] . "\n\nSản phẩm được quản lý trong hệ thống VACAMAXI, có thể chỉnh sửa nội dung, ảnh và SEO trong admin.",
                        'seo_title' => $item['name'] . ' | VACAMAXI',
                        'seo_description' => $item['short'],
                        'sort_order' => $sortOrder++,
                        'is_active' => true,
                    ],
                );
            }
        }

        $newsCategory = Category::query()
            ->where('module', Category::MODULE_NEWS)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->first();

        if (! $newsCategory) {
            return;
        }

        $posts = [
            ['title' => 'Nhà hàng Vaca Maxi và trải nghiệm steak cao cấp', 'image' => 'image/Rectangle 5.png'],
            ['title' => 'Chất lượng thịt bò Vaca Maxi đến từ đâu', 'image' => 'image/Rectangle 11.png'],
            ['title' => 'Rượu sâm 369 và hương vị nông nghiệp Việt', 'image' => 'image/Rectangle 4.png'],
            ['title' => 'Đội ngũ chuyên gia Argentina của Vaca Maxi', 'image' => 'image/Rectangle 2.png'],
            ['title' => 'Quy trình chọn lọc giống bò chủ lực', 'image' => 'image/Rectangle 3.png'],
            ['title' => 'Xây dựng chuỗi giá trị thịt bò bền vững', 'image' => 'image/Rectangle 11.png'],
            ['title' => 'Không gian nhà hàng 5 sao Vaca Maxi', 'image' => 'image/Rectangle 5.png'],
            ['title' => 'Xu hướng ẩm thực steak và grill hiện đại', 'image' => 'image/Rectangle 11.png'],
        ];

        foreach ($posts as $index => $item) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'category_id' => $newsCategory->id,
                    'title' => $item['title'],
                    'image' => $item['image'],
                    'description' => 'Nhà hàng steak và grill cao cấp, nơi ẩm thực không chỉ được thưởng thức bằng vị giác mà còn bằng trải nghiệm về nguyên liệu, không gian và câu chuyện sản phẩm.',
                    'content' => '<h2>' . e($item['title']) . '</h2><p>VACAMAXI phát triển hệ sinh thái sản phẩm dựa trên chất lượng nguyên liệu, quy trình chọn lọc và trải nghiệm khách hàng. Bài viết cung cấp góc nhìn về nhà hàng, sản phẩm và những giá trị mà VACAMAXI theo đuổi.</p><p>Mỗi sản phẩm được xây dựng với tinh thần bền vững, đảm bảo tính ổn định và phù hợp với nhu cầu thưởng thức hiện đại.</p>',
                    'seo_title' => $item['title'],
                    'seo_description' => 'Tin tức VACAMAXI về ẩm thực, thịt bò, rượu và nhà hàng.',
                    'published_at' => now()->subDays($index),
                    'is_active' => true,
                ],
            );
        }
    }
}
