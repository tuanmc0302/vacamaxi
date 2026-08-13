@php
    $ivfImage = $widgetImages($widget, ['/image/Rectangle 3.png'])->first();
    $ivfLead = __('IVF (thụ tinh trong ống nghiệm): tạo phôi bò chất lượng cao trong phòng thí nghiệm');
    $ivfSub = __('Tại VACAMAXI, chúng tôi không chỉ dừng lại ở “phôi giống thành công”. Chúng tôi chủ động kiểm soát chất lượng ngay từ gốc – từ phôi');
    $ivfBullets = [
        __('IVF (In Vitro Fertilization)'),
        __('hay còn gọi là thụ tinh ống nghiệm'),
        __('cho phép kết hợp trứng và tinh trùng trong phòng thí nghiệm để tạo ra phôi khỏe mạnh, được chọn lọc và xét nghiệm gen trước khi đưa vào bò mẹ.'),
        __('Điểm mạnh của IVF'),
        __('Chủ động chọn giới tính bê con ngay từ phôi'),
        __('Xét nghiệm DNA, loại trừ gen xấu'),
        __('Chọn lọc những cá thể có tiềm năng vượt trội'),
        __('Tự do quyết định thời điểm cấy phôi, phù hợp với kế hoạch đàn'),
        __('Tăng tỷ lệ mang thai và đảm bảo sự đồng đều trong đàn'),
        __('Tách biệt bò mẹ nền và bò có giá trị di truyền cao – tối ưu kinh tế'),
    ];
@endphp

<section class="about-scale-ivf">
    <div class="container">
        <div class="about-scale-ivf__intro">
            <h2>{{ __('IVF – Giải pháp VACAMAXI lựa chọn') }}</h2>
            <p>{{ $ivfLead }}</p>
            <p>{{ $ivfSub }}</p>
        </div>

        <div class="about-scale-split about-scale-split--ivf">
            <div class="about-scale-split__content about-scale-split__content--ivf">
                <h3>{{ __('IVF (In Vitro Fertilization)') }}</h3>
                @foreach ($ivfBullets as $line)
                    @if ($loop->index === 0 || $loop->index === 3)
                        <h4>{{ $line }}</h4>
                    @else
                        <p>– {{ $line }}</p>
                    @endif
                @endforeach
            </div>
            <div class="about-scale-split__image">
                <img src="{{ $ivfImage }}" alt="{{ __('IVF tại VACAMAXI') }}">
            </div>
        </div>
    </div>
</section>
