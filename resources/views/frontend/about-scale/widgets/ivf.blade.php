@php
    $ivfImage = $widgetImages($widget, ['/image/Rectangle 3.png'])->first();
    $ivfLead = 'IVF (thụ tinh trong ống nghiệm): tạo phôi bò chất lượng cao trong phòng thí nghiệm';
    $ivfSub = 'Tại VACA MAXI, chúng tôi không chỉ dừng lại ở “phôi giống thành công”. Chúng tôi chủ động kiểm soát chất lượng ngay từ gốc – từ phôi';
    $ivfBullets = [
        'IVF (In Vitro Fertilization)',
        'hay còn gọi là thụ tinh ống nghiệm',
        'cho phép kết hợp trứng và tinh trùng trong phòng thí nghiệm để tạo ra phôi khỏe mạnh, được chọn lọc và xét nghiệm gen trước khi đưa vào bò mẹ.',
        'Điểm mạnh của IVF',
        'Chủ động chọn giới tính bê con ngay từ phôi',
        'Xét nghiệm DNA, loại trừ gen xấu',
        'Chọn lọc những cá thể có tiềm năng vượt trội',
        'Tự do quyết định thời điểm cấy phôi, phù hợp với kế hoạch đàn',
        'Tăng tỷ lệ mang thai và đảm bảo sự đồng đều trong đàn',
        'Tách biệt bò mẹ nền và bò có giá trị di truyền cao – tối ưu kinh tế',
    ];
@endphp

<section class="about-scale-ivf">
    <div class="container">
        <div class="about-scale-ivf__intro">
            <h2>IVF – Giải pháp VACA MAXI lựa chọn</h2>
            <p>{{ $ivfLead }}</p>
            <p>{{ $ivfSub }}</p>
        </div>

        <div class="about-scale-split about-scale-split--ivf">
            <div class="about-scale-split__content about-scale-split__content--ivf">
                <h3>IVF (In Vitro Fertilization)</h3>
                @foreach ($ivfBullets as $line)
                    @if ($loop->index === 0 || $loop->index === 3)
                        <h4>{{ $line }}</h4>
                    @else
                        <p>– {{ $line }}</p>
                    @endif
                @endforeach
            </div>
            <div class="about-scale-split__image">
                <img src="{{ $ivfImage }}" alt="IVF tại VACA MAXI">
            </div>
        </div>
    </div>
</section>
