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
        $categoryNames = ['Rượu', 'Bò', 'Chuyên gia'];

        foreach ([Category::MODULE_PRODUCT, Category::MODULE_NEWS] as $module) {
            foreach ($categoryNames as $index => $name) {
                Category::query()->updateOrCreate(
                    ['module' => $module, 'slug' => Str::slug($name)],
                    [
                        'name' => $name,
                        'description' => null,
                        'sort_order' => $index + 1,
                        'is_active' => true,
                    ],
                );
            }
        }

        $productCategories = Category::query()
            ->where('module', Category::MODULE_PRODUCT)
            ->get()
            ->keyBy('slug');

        $products = [
            'ruou' => [
                ['name' => 'Rượu sâm 369 - 750ml', 'image' => 'image/Rectangle 4.png', 'short' => 'Dòng rượu sâm do VACA MAXI phát triển từ ngũ cốc quen thuộc với người Việt.'],
                ['name' => 'Rượu trắng Tam Cốc', 'image' => 'image/Rectangle 3.png', 'short' => 'Rượu trắng truyền thống, hậu vị mềm và phù hợp ẩm thực Việt.'],
                ['name' => 'Rượu vang Vaca Reserva', 'image' => 'image/Rectangle 5.png', 'short' => 'Rượu dùng kèm steak và các món bò cao cấp.'],
                ['name' => 'Rượu thảo mộc Vaca Maxi', 'image' => 'image/Rectangle 4.png', 'short' => 'Cân bằng hương thảo mộc nhẹ, vị êm và dễ uống.'],
                ['name' => 'Rượu mận Vaca Maxi', 'image' => 'image/Rectangle 3.png', 'short' => 'Hương trái cây dịu, phù hợp dùng trong các bữa tiệc thân mật.'],
            ],
            'bo' => [
                ['name' => 'Thịt Bò Vaca - A', 'image' => 'image/Rectangle 2.png', 'short' => 'Thịt mềm, vân mỡ đều, giàu hương vị tự nhiên.'],
                ['name' => 'Thịt Bò Vaca - I', 'image' => 'image/Rectangle 3.png', 'short' => 'Nạc nhưng vẫn có vân mỡ cân bằng giữa độ ngọt và độ béo.'],
                ['name' => 'Thịt Bò Vaca - X', 'image' => 'image/Rectangle 4.png', 'short' => 'Hương vị đặc biệt, nạc cao vượt trội.'],
                ['name' => 'Thịt Bò Vaca - B', 'image' => 'image/Rectangle 5.png', 'short' => 'Thịt chắc, mọng nước, lý tưởng cho chế biến công nghiệp.'],
                ['name' => 'Steak Vaca Maxi Prime', 'image' => 'image/Rectangle 11.png', 'short' => 'Phần steak tuyển chọn cho nhà hàng cao cấp.'],
            ],
            'chuyen-gia' => [
                ['name' => 'Chuyên gia dinh dưỡng Argentina', 'image' => 'image/Rectangle 2.png', 'short' => 'Tư vấn khẩu phần và tiêu chuẩn dinh dưỡng cho đàn bò.'],
                ['name' => 'Chuyên gia giống bò Vaca A', 'image' => 'image/Rectangle 11.png', 'short' => 'Phụ trách chọn lọc giống nền Angus và đánh giá chất lượng thịt.'],
                ['name' => 'Chuyên gia giống bò Vaca I', 'image' => 'image/Rectangle 2.png', 'short' => 'Phụ trách lai tạo và phát triển đặc tính cân bằng nạc mỡ.'],
                ['name' => 'Chuyên gia giống bò Vaca X', 'image' => 'image/Rectangle 3.png', 'short' => 'Định hướng phát triển dòng bò nạc cao, năng suất ổn định.'],
                ['name' => 'Chuyên gia vận hành chuỗi Vaca Maxi', 'image' => 'image/Rectangle 5.png', 'short' => 'Tư vấn tiêu chuẩn vận hành trang trại, chế biến và nhà hàng.'],
            ],
        ];

        $sortOrder = 1;

        foreach ($products as $categorySlug => $items) {
            $category = $productCategories->get($categorySlug);

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
                        'description' => $item['short'] . "\n\nSản phẩm được quản lý trong hệ thống VACA MAXI, có thể chỉnh sửa nội dung, ảnh và SEO trong admin.",
                        'seo_title' => $item['name'] . ' | VACA MAXI',
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
            ['title' => 'Nha hang Vaca Maxi va trai nghiem steak cao cap', 'image' => 'image/Rectangle 5.png'],
            ['title' => 'Chat luong thit bo Vaca Maxi den tu dau', 'image' => 'image/Rectangle 11.png'],
            ['title' => 'Ruou sam 369 va huong vi nong nghiep Viet', 'image' => 'image/Rectangle 4.png'],
            ['title' => 'Doi ngu chuyen gia Argentina cua Vaca Maxi', 'image' => 'image/Rectangle 2.png'],
            ['title' => 'Quy trinh chon loc giong bo chu luc', 'image' => 'image/Rectangle 3.png'],
            ['title' => 'Xay dung chuoi gia tri thit bo ben vung', 'image' => 'image/Rectangle 11.png'],
            ['title' => 'Khong gian nha hang 5 sao Vaca Maxi', 'image' => 'image/Rectangle 5.png'],
            ['title' => 'Xu huong am thuc steak va grill hien dai', 'image' => 'image/Rectangle 11.png'],
        ];

        foreach ($posts as $index => $item) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'category_id' => $newsCategory->id,
                    'title' => $item['title'],
                    'image' => $item['image'],
                    'description' => 'Nha hang steak va grill cao cap, noi am thuc khong chi duoc thuong thuc bang vi giac ma con bang trai nghiem ve nguyen lieu, khong gian va cau chuyen san pham.',
                    'content' => '<h2>'.$item['title'].'</h2><p>VACA MAXI phat trien he sinh thai san pham dua tren chat luong nguyen lieu, quy trinh chon loc va trai nghiem khach hang. Bai viet cung cap goc nhin ve nha hang, san pham va nhung gia tri ma VACA MAXI theo duoi.</p><p>Moi san pham duoc xay dung voi tinh than ben vung, dam bao tinh on dinh va phu hop voi nhu cau thuong thuc hien dai.</p>',
                    'seo_title' => $item['title'],
                    'seo_description' => 'Tin tuc VACA MAXI ve am thuc, thit bo, ruou va nha hang.',
                    'published_at' => now()->subDays($index),
                    'is_active' => true,
                ],
            );
        }
    }
}
