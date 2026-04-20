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
                'title' => 'VACAMAXI là nhà hàng steak & grill cao cấp',
                'sub_title' => 'Nhà hàng 5 sao VACAMAXI',
                'description' => 'Nơi ẩm thực không chỉ được thưởng thức bằng vị giác, mà còn được cảm nhận bằng thẩm mỹ, không gian và chiều sâu của chuyện phía sau mỗi lựa chọn.',
                'settings' => ['button_text' => 'KHÁM PHÁ NGAY', 'button_url' => '#about'],
                'sort_order' => 10,
            ],
            [
                'key' => 'about_me_home',
                'title' => 'VỀ VACAMAXI',
                'sub_title' => null,
                'description' => 'VACAMAXI tiên phong kiến tạo hệ sinh thái chăn nuôi công nghệ cao tại Việt Nam. Hợp tác cùng chuyên gia hàng đầu Argentina, chúng tôi phát triển bò giống và thịt bò chất lượng cao theo chuẩn quốc tế. Mở rộng chuỗi giá trị với rượu cao cấp và nhà hàng tinh tuyển, VACAMAXI mang đến giá trị bền vững và trải nghiệm đẳng cấp.',
                'settings' => [
                    'button_text' => 'Tìm hiểu thêm',
                    'button_url' => '/gioi-thieu',
                    'images' => ['/image/Rectangle 2.png', '/image/Rectangle 3.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png'],
                ],
                'sort_order' => 20,
            ],
            [
                'key' => 'product_option_one',
                'title' => 'CÁC GIỐNG BÒ VACAMAXI',
                'sub_title' => 'GIỐNG BÒ CỦA CHÚNG TÔI',
                'description' => 'Mỗi giống bò tại VACAMAXI là kết quả của quá trình chọn lọc và phát triển di truyền nghiêm ngặt, đảm bảo năng suất và chất lượng vượt trội.',
                'settings' => ['button_text' => 'XEM THÊM', 'button_url' => '/san-pham', 'highlight' => 'CÁC GIỐNG BÒ'],
                'sort_order' => 30,
            ],
            [
                'key' => 'about_team_home',
                'title' => 'ĐỘI NGŨ CHUYÊN GIA CỦA VACAMAXI',
                'sub_title' => 'Hợp tác giữa VACAMAXI và chuyên gia Argentina',
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
                'title' => 'CHẤT LƯỢNG THỊT BÒ VACAMAXI',
                'sub_title' => 'SẢN PHẨM VỀ THỊT BÒ',
                'description' => 'Mỗi giống bò tại VACAMAXI là kết quả của quá trình chọn lọc và phát triển di truyền nghiêm ngặt, đảm bảo năng suất và chất lượng vượt trội.',
                'settings' => ['button_text' => 'XEM THÊM', 'button_url' => '/san-pham', 'highlight' => 'VACAMAXI'],
                'sort_order' => 50,
            ],
            [
                'key' => 'product_option_three',
                'title' => 'SẢN PHẨM RƯỢU VACAMAXI',
                'sub_title' => 'TINH HOA NÔNG NGHIỆP',
                'description' => 'Rượu truyền thống do VACAMAXI phát triển, được nấu từ các loại ngũ cốc quen thuộc với người Việt.',
                'settings' => ['button_text' => 'XEM THÊM', 'button_url' => '/san-pham', 'highlight' => 'SẢN PHẨM RƯỢU'],
                'sort_order' => 60,
            ],
            [
                'key' => 'about_restaurant_home',
                'title' => 'NHÀ HÀNG 5 SAO VACAMAXI',
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
                'description' => 'Những chia sẻ thực tế từ khách hàng sau khi trải nghiệm VACAMAXI.',
                'settings' => [
                    'items' => [
                        ['avatar' => '/image/Rectangle 2.png', 'role' => 'Khach hang', 'name' => 'Hoang Trang', 'content' => 'Thit bo VACAMAXI that su chat luong. Bo mem, tuoi va duoc nem nem rat vua mieng.'],
                        ['avatar' => '/image/Rectangle 3.png', 'role' => 'Khach hang', 'name' => 'Tung Phan', 'content' => 'Dung chuan quan bo cho nguoi me thit. Khong gian dep, nhan vien than thien, tu van mon rat co tam.'],
                        ['avatar' => '/image/Rectangle 4.png', 'role' => 'Khach hang', 'name' => 'Minh Anh', 'content' => 'Mon an chin chu, ruou dung kem rat hop vi va khong gian phu hop cho bua toi gia dinh.'],
                        ['avatar' => '/image/Rectangle 5.png', 'role' => 'Khach hang', 'name' => 'Quoc Huy', 'content' => 'Bo nuong vua do, thit ngot va nhan vien phuc vu nhanh. Trai nghiem rat dang quay lai.'],
                        ['avatar' => '/image/Rectangle 2.png', 'role' => 'Khach hang', 'name' => 'Thanh Mai', 'content' => 'Toi thich cach VACAMAXI tu van phan thit phu hop. Chat luong moi lan ghe deu rat on dinh.'],
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
            [
                'key' => 'about_page_hero',
                'title' => 'GIỚI THIỆU',
                'sub_title' => 'VỀ VACAMAXI',
                'description' => 'VACAMAXI ra đời với khát vọng thay đổi cục diện ngành chăn nuôi Việt Nam. Trong bối cảnh người tiêu dùng ngày càng đòi hỏi cao về chất lượng thịt bò, ngành chăn nuôi trong nước vẫn còn nhiều hạn chế về giống, quy trình và năng suất. VACAMAXI xuất hiện như một biểu tượng cho đổi mới công nghệ và chuyển giao tri thức toàn cầu, đặt nền móng cho hệ sinh thái chăn nuôi hiện đại và bền vững.',
                'settings' => [],
                'sort_order' => 100,
            ],
            [
                'key' => 'about_page_intro',
                'title' => 'VACAMAXI',
                'sub_title' => 'Từ phôi giống đến miếng thịt - Mỗi bước đều được chăm chút bằng khoa học và tâm huyết.',
                'description' => 'Tầm nhìn đến 2035: Trở thành thương hiệu dẫn đầu châu Á trong lĩnh vực bò giống, bò thịt, chăn nuôi công nghệ cao và sản phẩm nông nghiệp giá trị gia tăng.|Sứ mệnh: Tiên phong ứng dụng công nghệ sinh học để đổi mới ngành chăn nuôi bò thịt Việt Nam, cung cấp sản phẩm sạch, chất lượng cao và bền vững.',
                'settings' => [
                    'images' => ['/image/Rectangle 11.png', '/image/Rectangle 2.png', '/image/Rectangle 4.png', '/image/Rectangle 5.png'],
                ],
                'sort_order' => 110,
            ],
            [
                'key' => 'about_page_values',
                'title' => 'Giá trị cốt lõi',
                'sub_title' => null,
                'description' => 'Công nghệ tiên phong:Ứng dụng công nghệ hiện đại trong toàn chuỗi sản xuất để kiểm soát từ nguồn gốc đến thành phẩm.|Cam kết chất lượng:Tuân thủ tiêu chuẩn nghiêm ngặt để đảm bảo mỗi sản phẩm luôn ổn định và an toàn.|Phát triển bền vững:Kết hợp hiệu quả kinh tế với trách nhiệm môi trường và cộng đồng.|Hợp tác toàn diện:Liên kết chuyên gia, nông hộ và doanh nghiệp để cùng nâng tầm hệ sinh thái nông nghiệp.|Minh bạch uy tín:Xây dựng niềm tin bằng dữ liệu, quy trình và kiểm chứng chất lượng rõ ràng.',
                'settings' => [],
                'sort_order' => 120,
            ],
            [
                'key' => 'about_page_experts',
                'title' => 'Đội ngũ chuyên gia của VACAMAXI',
                'sub_title' => null,
                'description' => 'Hợp tác giữa VACAMAXI và các chuyên gia Argentina giúp hệ thống sản xuất được vận hành theo chuẩn quốc tế, từ dinh dưỡng, sức khỏe đàn đến kiểm soát chất lượng thịt.|Đội ngũ chuyên gia không chỉ cố vấn mà còn trực tiếp chuyển giao kỹ thuật, đào tạo nhân sự và chuẩn hóa quy trình để nâng cao năng lực nội địa.',
                'settings' => [
                    'images' => ['/image/Rectangle 3.png'],
                ],
                'sort_order' => 130,
            ],
            [
                'key' => 'about_page_farm',
                'title' => 'Mô hình trang trại',
                'sub_title' => null,
                'description' => 'Trang trại VACAMAXI tại Tản Lĩnh, Ba Vì, Hà Nội được quy hoạch theo mô hình khép kín và tự chủ toàn diện, kết nối các mắt xích từ giống, thức ăn, chăm sóc đến phân phối.|Mô hình này giúp đảm bảo nguồn thức ăn xanh tự nhiên, tăng khả năng kiểm soát chất lượng và tối ưu hiệu quả vận hành lâu dài.',
                'settings' => [
                    'images' => ['/image/Rectangle 11.png'],
                ],
                'sort_order' => 140,
            ],
            [
                'key' => 'about_page_cta',
                'title' => 'Khám phá quy mô phát triển',
                'sub_title' => null,
                'description' => 'Xem chi tiết năng lực vận hành chuỗi từ trang trại, nhà máy đến hệ thống phân phối của VACAMAXI.',
                'settings' => ['button_text' => 'Xem trang quy mô', 'button_url' => '/gioi-thieu-quy-mo'],
                'sort_order' => 150,
            ],
            [
                'key' => 'about_scale_page_hero',
                'title' => 'QUY MÔ - CÔNG NGHỆ',
                'sub_title' => 'MÔ HÌNH TRANG TRẠI KHÉP KÍN',
                'description' => 'Mô hình trang trại khép kín - đồng bộ - hiện đại|Trang trại VACAMAXI đặt tại Tản Lĩnh, Ba Vì, Hà Nội, được quy hoạch trên diện tích 39 ha, theo mô hình khép kín và tự chủ toàn diện.|Hệ thống bao gồm:|– Chuồng trại tiêu chuẩn – Xưởng chế biến thức ăn riêng biệt|– Trung tâm sản xuất phôi công nghệ cao – Khu văn phòng, sân bãi, khu cảnh quan sinh thái|– Diện tích trồng cỏ – đảm bảo nguồn thức ăn xanh tự nhiên',
                'settings' => [],
                'sort_order' => 160,
            ],
            [
                'key' => 'about_scale_page_farm',
                'title' => 'Mô hình trang trại',
                'sub_title' => null,
                'description' => 'Trang trại được đầu tư bài bản, đảm bảo vận hành khép kín từ giống - thức ăn - chăm sóc - xử lý môi trường - phân phối sản phẩm.|Hệ thống được thiết kế và vận hành dưới sự giám sát của đội ngũ chuyên gia, kết hợp công nghệ sinh học với kinh nghiệm thực địa nhằm nâng cao năng suất đàn bò và kiểm soát chất lượng đồng đều.',
                'settings' => [
                    'images' => ['/image/Rectangle 11.png'],
                ],
                'sort_order' => 170,
            ],
            [
                'key' => 'about_scale_page_experts',
                'title' => 'Đội ngũ chuyên gia VACAMAXI',
                'sub_title' => null,
                'description' => 'Dr. Daniel Salamone|Tiến sĩ Rajneesh Verma|Dr. Federico Allegroni|Dr. Nicholas Farnetano|Dr. Verónica Gorleri|Dr. Juan Manuel Álvarez|Dr. Martín Romeo|Dr. Victoria Amusquibar',
                'settings' => [],
                'sort_order' => 180,
            ],
            [
                'key' => 'about_scale_page_care',
                'title' => 'Chế độ chăm sóc và dinh dưỡng chuyên biệt',
                'sub_title' => null,
                'description' => 'Mỗi cá thể bò tại VACAMAXI được chăm sóc theo một chế độ riêng biệt, tùy theo giai đoạn phát triển. Thức ăn được sản xuất tại chỗ, kiểm soát công thức phối trộn và dinh dưỡng.|Quy trình theo dõi sức khỏe được lập trình tự động giúp giảm thiểu rủi ro, tăng tính đồng đều của đàn và duy trì chất lượng thịt đạt chuẩn cao.',
                'settings' => [
                    'images' => ['/image/Rectangle 2.png'],
                ],
                'sort_order' => 190,
            ],
            [
                'key' => 'about_scale_page_biotech',
                'title' => 'Công nghệ sinh học',
                'sub_title' => null,
                'description' => 'VACAMAXI tiên phong ứng dụng công nghệ sinh học trong toàn bộ quy trình nhân giống và chăn nuôi phát triển trên toàn quốc.|Nền tảng của chúng tôi là sự kết hợp giữa dữ liệu di truyền, kỹ thuật IVF và quản trị đàn theo tiêu chuẩn cao, giúp tối ưu tỷ lệ thành công và chất lượng con giống.',
                'settings' => [
                    'images' => ['/image/Rectangle 5.png'],
                ],
                'sort_order' => 200,
            ],
            [
                'key' => 'about_scale_page_ivf',
                'title' => 'Vì sao chúng tôi chọn IVF?',
                'sub_title' => null,
                'description' => 'IVF đòi hỏi đầu tư lớn về thiết bị, nhân lực và quy trình kỹ thuật cao, nhưng đây là con đường cần thiết để tạo ra một đàn bò đồng đều - khỏe mạnh - hiệu suất cao, phục vụ cho chuỗi chăn nuôi, chế biến và thương mại khép kín.',
                'settings' => [],
                'sort_order' => 210,
            ],
            [
                'key' => 'about_scale_page_strategy',
                'title' => 'Chiến lược phát triển từ phôi giống chọn lọc giới tính',
                'sub_title' => null,
                'description' => 'Cấy phôi vào bò nền để tạo bò sinh sản:Phát triển đàn bò cái nền có chất lượng di truyền cao để tăng sản lượng bê chất lượng và tạo nguồn giống ổn định lâu dài cho hệ thống.|Cấy phôi vào bò đực để phát triển bò thịt cao cấp:Tạo đàn bò đực tăng trưởng nhanh, tỷ lệ thịt cao, phù hợp mô hình chăn nuôi lấy thịt và mở rộng cung ứng cho phân khúc thịt bò cao cấp.',
                'settings' => [
                    'images' => ['/image/Rectangle 11.png', '/image/Rectangle 11.png'],
                ],
                'sort_order' => 220,
            ],
            [
                'key' => 'about_scale_page_cta',
                'title' => 'Tìm hiểu thêm về VACAMAXI',
                'sub_title' => null,
                'description' => 'Quay lại trang giới thiệu để xem tổng quan tầm nhìn, sứ mệnh và giá trị cốt lõi của chúng tôi.',
                'settings' => ['button_text' => 'Về trang giới thiệu', 'button_url' => '/gioi-thieu'],
                'sort_order' => 230,
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
