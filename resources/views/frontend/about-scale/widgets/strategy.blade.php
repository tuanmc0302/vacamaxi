@php
    $strategyTop = 'Vì sao chúng tôi chọn IVF?';
    $strategyLead = $widgets->get('about_scale_page_ivf')?->description ?: 'IVF đòi hỏi đầu tư lớn về thiết bị chuyên dụng và đội ngũ kỹ thuật có trình độ cao. Nhưng với VACAMAXI, đó là con đường cần thiết để tạo ra một đàn bò đồng đều – khỏe mạnh – hiệu suất cao, phục vụ cho chuỗi chăn nuôi – chế biến – thương mại khép kín của VACAMAXI';
    $strategyTitle = $widget->title ?: 'Chiến lược phát triển từ phôi giống chọn lọc giới tính gồm 2 hướng phát triển';
    $strategyImages = $widgetImages($widget, ['/image/Rectangle 2.png', '/image/Rectangle 11.png']);
    $strategyCards = [
        [
            'image' => $strategyImages->get(0, '/image/Rectangle 2.png'),
            'title' => 'Cấy phôi vào bò nền để tạo bò sinh sản',
            'body' => [
                'Phát triển đàn bò cái nền có chất lượng di truyền cao để nâng cao năng suất sinh sản',
                'Đối tượng',
                'Áp dụng: Bò cái nền của các hộ dân, trang trại chăn nuôi nhỏ và vừa.',
                'Lợi ích:',
                'Tạo ra thế hệ bò mẹ có ưu thế di truyền vượt trội, gia tăng số lượng bê chất lượng cao.',
                'Cung cấp nguồn bò cái hậu bị cho thị trường, đảm bảo chuỗi sản xuất bền vững.',
                'Giúp hộ dân nâng cao giá trị kinh tế từ việc bán bê con hoặc tiếp tục nhân giống.',
            ],
        ],
        [
            'image' => $strategyImages->get(1, '/image/Rectangle 11.png'),
            'title' => 'Cấy phôi vào bò đực để phát triển bò thịt cao cấp',
            'body' => [
                'Sản xuất bò thịt có tốc độ tăng trưởng nhanh, chất lượng thịt vượt trội theo tiêu chuẩn quốc tế',
                'Đối tượng áp dụng: Các trang trại chăn nuôi bò thịt quy mô lớn, hợp tác xã và doanh nghiệp chế biến thịt.',
                'Lợi ích:',
                'Tạo ra đàn bò đực tăng trưởng nhanh, tỷ lệ thịt cao, phù hợp mô hình chăn nuôi lấy thịt.',
                'Đáp ứng nhu cầu thị trường về thịt bò cao cấp, mở rộng cơ hội xuất khẩu.',
                'Tận dụng tối đa nguồn thức ăn chuyên biệt để tối ưu chất lượng thịt và hiệu suất chăn nuôi.',
            ],
        ],
    ];
@endphp

<section class="about-scale-strategy">
    <div class="container">
        <div class="about-scale-strategy__intro">
            <h2>{{ $strategyTop }}</h2>
            <p>{{ $strategyLead }}</p>
            <h3>{{ $strategyTitle }}</h3>
        </div>

        <div class="about-scale-strategy__grid">
            @foreach ($strategyCards as $card)
                <article class="about-scale-strategy-card">
                    <div class="about-scale-strategy-card__image">
                        <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}">
                    </div>
                    <div class="about-scale-strategy-card__body">
                        <h4>{{ $card['title'] }}</h4>
                        @foreach ($card['body'] as $line)
                            @if (str_ends_with($line, ':') || in_array($line, ['Đối tượng', 'Lợi ích:'], true))
                                <h5>{{ rtrim($line) }}</h5>
                            @else
                                <p>{{ str_starts_with($line, 'Áp') || str_starts_with($line, 'Sản') || str_starts_with($line, 'Phát') ? $line : '– ' . $line }}</p>
                            @endif
                        @endforeach
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
