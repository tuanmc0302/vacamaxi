<?php

namespace Database\Seeders;

use App\Models\FrontendWidget;
use Illuminate\Database\Seeder;

class FrontendWidgetSeeder extends Seeder
{
    public function run(): void
    {
        $widgets = [
            [
                'key' => 'banner_home',
                'title' => 'VACA MAXI là nhà hàng steak & grill cao cấp',
                'sub_title' => 'Nhà hàng 5 sao Vaca Maxi',
                'description' => 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của chuyện phía sau mỗi lựa chọn.',
                'settings' => ['button_text' => 'KHÁM PHÁ NGAY', 'button_url' => '#about'],
                'sort_order' => 10,
            ],
            [
                'key' => 'about_me_home',
                'title' => 'VỀ VACA MAXI',
                'sub_title' => null,
                'description' => 'VACA MAXI tiên phong kiến tạo hệ sinh thái chăn nuôi công nghệ cao tại Việt Nam. Hợp tác cùng chuyên gia hàng đầu Argentina, chúng tôi phát triển bò giống và thịt bò chất lượng cao theo chuẩn quốc tế. Mở rộng chuỗi giá trị với rượu cao cấp và nhà hàng tinh tuyển, VACA MAXI mang đến giá trị bền vững và trải nghiệm đẳng cấp.',
                'settings' => [
                    'button_text' => 'Tìm hiểu thêm',
                    'button_url' => '/gioi-thieu',
                    'images' => ['/image/Rectangle 2.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png'],
                ],
                'sort_order' => 20,
            ],
            [
                'key' => 'product_option_one',
                'title' => 'CÁC GIỐNG BÒ VACA MAXI',
                'sub_title' => 'GIỐNG BÒ CỦA CHÚNG TÔI',
                'description' => 'Mỗi giống bò tại VACA MAXI là kết quả của quá trình chọn lọc và phát triển di truyền nghiêm ngặt, đảm bảo năng suất và chất lượng vượt trội.',
                'settings' => ['button_text' => 'XEM THÊM', 'button_url' => '/san-pham', 'highlight' => 'CÁC GIỐNG BÒ'],
                'sort_order' => 30,
            ],
            [
                'key' => 'about_team_home',
                'title' => 'ĐỘI NGŨ CHUYÊN GIA CỦA VACA MAXI',
                'sub_title' => 'Hợp tác giữa Vaca Maxi và chuyên gia Argentina',
                'description' => 'Hệ thống sản xuất chăn nuôi được thiết kế và triển khai bởi đội ngũ chuyên gia hàng đầu thế giới. Các chuyên gia có chuyên môn về dinh dưỡng động vật, sức khỏe bò và chất lượng thịt, chịu trách nhiệm giám sát toàn bộ quy trình từ chẩn đoán thai kỳ, sinh sản, đến giai đoạn vỗ béo và lấy thịt.',
                'settings' => [
                    'button_text' => 'Tìm hiểu thêm',
                    'button_url' => '/gioi-thieu',
                    'images' => ['/image/Rectangle 2.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png'],
                ],
                'sort_order' => 40,
            ],
            [
                'key' => 'product_option_two',
                'title' => 'CHẤT LƯỢNG THỊT BÒ VACA MAXI',
                'sub_title' => 'SẢN PHẨM VỀ THỊT BÒ',
                'description' => 'Mỗi giống bò tại VACA MAXI là kết quả của quá trình chọn lọc và phát triển di truyền nghiêm ngặt, đảm bảo năng suất và chất lượng vượt trội.',
                'settings' => ['button_text' => 'XEM THÊM', 'button_url' => '/san-pham', 'highlight' => 'VACA MAXI'],
                'sort_order' => 50,
            ],
            [
                'key' => 'product_option_three',
                'title' => 'SẢN PHẨM RƯỢU VACA MAXI',
                'sub_title' => 'TINH HOA NÔNG NGHIỆP',
                'description' => 'Rượu truyền thống do VACA MAXI phát triển, được nấu từ các loại ngũ cốc quen thuộc với người Việt.',
                'settings' => ['button_text' => 'XEM THÊM', 'button_url' => '/san-pham', 'highlight' => 'SẢN PHẨM RƯỢU'],
                'sort_order' => 60,
            ],
            [
                'key' => 'about_restaurant_home',
                'title' => 'NHÀ HÀNG 5 SAO VACA MAXI',
                'sub_title' => null,
                'description' => 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của câu chuyện phía sau mỗi lựa chọn.',
                'settings' => [
                    'button_text' => 'XEM THÊM',
                    'button_url' => '/san-pham',
                    'images' => ['/image/Rectangle 5.png', '/image/Rectangle 3.png', '/image/Rectangle 2.png', '/image/Rectangle 11.png'],
                ],
                'sort_order' => 70,
            ],
            [
                'key' => 'feedback_home',
                'title' => 'ĐÁNH GIÁ CỦA KHÁCH HÀNG',
                'sub_title' => 'trên Google Maps',
                'description' => 'Những chia sẻ thực tế từ khách hàng sau khi trải nghiệm VACA MAXI.',
                'settings' => [
                    'items' => [
                        ['avatar' => '/image/Rectangle 2.png', 'role' => 'Khach hang', 'name' => 'Hoang Trang', 'content' => 'Thit bo Vaca Maxi that su chat luong. Bo mem, tuoi va duoc nem nem rat vua mieng.'],
                        ['avatar' => '/image/Rectangle 3.png', 'role' => 'Khach hang', 'name' => 'Tung Phan', 'content' => 'Dung chuan quan bo cho nguoi me thit. Khong gian dep, nhan vien than thien, tu van mon rat co tam.'],
                        ['avatar' => '/image/Rectangle 4.png', 'role' => 'Khach hang', 'name' => 'Minh Anh', 'content' => 'Mon an chin chu, ruou dung kem rat hop vi va khong gian phu hop cho bua toi gia dinh.'],
                        ['avatar' => '/image/Rectangle 5.png', 'role' => 'Khach hang', 'name' => 'Quoc Huy', 'content' => 'Bo nuong vua do, thit ngot va nhan vien phuc vu nhanh. Trai nghiem rat dang quay lai.'],
                        ['avatar' => '/image/Rectangle 2.png', 'role' => 'Khach hang', 'name' => 'Thanh Mai', 'content' => 'Toi thich cach Vaca Maxi tu van phan thit phu hop. Chat luong moi lan ghe deu rat on dinh.'],
                        ['avatar' => '/image/Rectangle 3.png', 'role' => 'Khach hang', 'name' => 'Duc Nam', 'content' => 'Nha hang co chat luong thit tot, muc che bien dung yeu cau va bo tri khong gian thoai mai.'],
                        ['avatar' => '/image/Rectangle 4.png', 'role' => 'Khach hang', 'name' => 'Lan Phuong', 'content' => 'Phan ruou sam 369 goi y trong bua an rat hop. Mot dia chi nen thu khi thich steak.'],
                        ['avatar' => '/image/Rectangle 5.png', 'role' => 'Khach hang', 'name' => 'Gia Bao', 'content' => 'Toi danh gia cao nguyen lieu va cach phuc vu. Moi thu rat gon gang, chuyen nghiep.'],
                        ['avatar' => '/image/Rectangle 2.png', 'role' => 'Khach hang', 'name' => 'Kim Ngan', 'content' => 'Khong gian am, mon ra dung nhip va chat luong thit tao cam giac rat yen tam.'],
                        ['avatar' => '/image/Rectangle 3.png', 'role' => 'Khach hang', 'name' => 'Anh Tuan', 'content' => 'Da an thu nhieu lan va chat luong van deu. Chat thit ro, nuong ngon, phuc vu lich su.'],
                    ],
                ],
                'sort_order' => 80,
            ],
            [
                'key' => 'news_home',
                'title' => 'GÓC NHÌN & XU HƯỚNG',
                'sub_title' => 'TIN TỨC MỚI NHẤT',
                'description' => 'Tin tức mới nhất - góc nhìn từ nông nghiệp bền vững đến nhà hàng hiện đại, kết nối văn hóa ẩm thực và những xu hướng đang định hình thị trường.',
                'settings' => ['button_text' => 'XEM THÊM', 'button_url' => '/tin-tuc', 'highlight' => 'XU HƯỚNG'],
                'sort_order' => 90,
            ],
        ];

        foreach ($widgets as $widget) {
            FrontendWidget::query()->updateOrCreate(
                ['key' => $widget['key']],
                $widget + ['is_active' => true]
            );
        }
    }
}
