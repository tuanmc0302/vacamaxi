@extends('frontend.master')

@php
    $pageTitle = __('Giống bò VACAMAXI - GIỐNG BÒ CỦA CHÚNG TÔI');
    $metaDescription = __('Mỗi giống bò tại VACAMAXI là kết quả của quá trình chọn lọc và phát triển di truyền nghiêm ngặt, đảm bảo năng xuất và chất lượng vượt trội');
    $active = 'breeds';
    $comparison = $frontendData['comparison'] ?? [];
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/frontend/products.css') }}">
    <style>
        .breeds-intro {
            padding: 80px 0 40px;
            text-align: center;
        }
        .breeds-intro h2 {
            font-size: 40px;
            font-weight: 800;
            color: #250900;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .breeds-intro p {
            font-size: 18px;
            color: #666;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }
        .breed-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 80px;
        }

        /* Comparison Table Styles */
        .comparison-section {
            padding: 80px 0;
            background: #fcfcfc;
        }
        .comparison-title {
            text-align: center;
            margin-bottom: 50px;
        }
        .comparison-title h3 {
            font-size: 28px;
            font-weight: 700;
            color: #250900;
            text-transform: uppercase;
        }
        .comparison-table-wrapper {
            overflow-x: auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }
        .comparison-table th {
            background: #250900;
            color: #f3b21a;
            padding: 20px;
            text-align: center;
            font-weight: 700;
            text-transform: uppercase;
            border: 1px solid #3d1405;
        }
        .comparison-table td {
            padding: 15px 20px;
            border: 1px solid #eee;
            text-align: center;
            font-size: 15px;
            color: #444;
        }
        .comparison-table tr td:first-child {
            background: #fcfcfc;
            font-weight: 700;
            color: #250900;
            text-align: left;
            width: 200px;
        }
        .comparison-table tr:hover td {
            background: #fff9ed;
        }

        /* Cooperation Form Styles */
        .cooperation-section {
            padding: 80px 0;
            background: #fff;
        }
        .cooperation-card {
            max-width: 900px;
            margin: 0 auto;
            background: #250900;
            border-radius: 30px;
            padding: 60px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .cooperation-card::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(243, 178, 26, 0.1) 0%, transparent 70%);
            z-index: 0;
        }
        .cooperation-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }
        .cooperation-header h2 {
            font-size: 36px;
            font-weight: 800;
            color: #f3b21a;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .cooperation-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            position: relative;
            z-index: 1;
        }
        .form-group.full-width {
            grid-column: span 2;
        }
        .cooperation-form input, .cooperation-form textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(243, 178, 26, 0.3);
            border-radius: 10px;
            padding: 15px 20px;
            color: #fff;
            outline: none;
            transition: all 0.3s;
        }
        .cooperation-form input:focus, .cooperation-form textarea:focus {
            border-color: #f3b21a;
            background: rgba(255, 255, 255, 0.1);
        }
        .cooperation-form input::placeholder, .cooperation-form textarea::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }
        .btn-submit-coop {
            grid-column: span 2;
            background: #f3b21a;
            color: #250900;
            border: none;
            border-radius: 50px;
            padding: 18px;
            font-weight: 800;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }
        .btn-submit-coop:hover {
            background: #ffc642;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .success-message {
            display: none;
            background: rgba(40, 167, 69, 0.2);
            border: 1px solid #28a745;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }

        @media (max-width: 991px) {
            .breed-grid { grid-template-columns: repeat(2, 1fr); }
            .cooperation-card { padding: 40px; }
            .cooperation-form { grid-template-columns: 1fr; }
            .form-group.full-width, .btn-submit-coop { grid-column: span 1; }
        }
        @media (max-width: 575px) {
            .breed-grid { grid-template-columns: 1fr; }
            .breeds-intro h2 { font-size: 32px; }
            .cooperation-card { padding: 30px 20px; }
        }
    </style>
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>GIỐNG BÒ CỦA CHÚNG TÔI</h1>
            <p>Trang chủ / Sản phẩm / Giống bò</p>
        </div>
    </section>

    <div class="container">
        <div class="breeds-intro">
            <h2>CÁC GIỐNG BÒ VACAMAXI</h2>
            <p>Mỗi giống bò tại VACAMAXI là kết quả của quá trình chọn lọc và phát triển di truyền nghiêm ngặt, đảm bảo năng xuất và chất lượng vượt trội.</p>
        </div>

        <div class="breed-grid">
            @forelse ($breeds as $breed)
                @include('frontend.products._card', [
                    'product' => $breed, 
                    'hideCategory' => true, 
                    'showDescription' => true
                ])
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Đang cập nhật danh sách giống bò...</p>
                </div>
            @endforelse
        </div>
    </div>

    <section class="comparison-section">
        <div class="container">
            <div class="comparison-title">
                <h3>Tại VACAMAXI, Chúng tôi chọn lọc và nhân giống 4 dòng bò chủ lực</h3>
            </div>
            
            <div class="comparison-table-wrapper">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Tiêu chí</th>
                            <th>Vaca - A</th>
                            <th>Vaca - B</th>
                            <th>Vaca - G</th>
                            <th>Vaca - I</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Vân mỡ</td>
                            <td>Vừa phải, đều</td>
                            <td>Trung bình</td>
                            <td>Rất cao, mịn</td>
                            <td>Cân bằng nạc & mỡ</td>
                        </tr>
                        <tr>
                            <td>Độ mềm thịt</td>
                            <td>Mềm, dễ chế biến</td>
                            <td>Chắc, mọng nước</td>
                            <td>Mềm tan</td>
                            <td>Mềm mọng, đậm vị</td>
                        </tr>
                        <tr>
                            <td>Hương vị</td>
                            <td>Cân bằng</td>
                            <td>Thơm, giữ ẩm tốt</td>
                            <td>Tinh tế, béo ngậy</td>
                            <td>Đặc trưng gen lai</td>
                        </tr>
                        <tr>
                            <td>Dinh dưỡng</td>
                            <td>Chất béo không bão hòa</td>
                            <td>Cân đối</td>
                            <td>Omega-3, Omega-6</td>
                            <td>Ổn định</td>
                        </tr>
                        <tr>
                            <td>Tốc độ tăng trưởng</td>
                            <td>Ổn định</td>
                            <td>Nhanh</td>
                            <td>Chậm hơn</td>
                            <td>Rất nhanh</td>
                        </tr>
                        <tr>
                            <td>Đề kháng & thích nghi</td>
                            <td>Tốt</td>
                            <td>Rất cao</td>
                            <td>Trung bình</td>
                            <td>Rất cao</td>
                        </tr>
                        <tr>
                            <td>Phù hợp mục đích</td>
                            <td>Nhà hàng bán lẻ</td>
                            <td>Trang trại, chế biến</td>
                            <td>Cao cấp, xuất khẩu</td>
                            <td>Thương mại quy mô lớn</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="cooperation-section">
        <div class="container">
            <div class="cooperation-card">
                <div class="cooperation-header">
                    <h2>LIÊN HỆ HỢP TÁC</h2>
                    <p>Hợp tác cùng VACAMAXI để cùng phát triển ngành chăn nuôi bền vững</p>
                </div>

                <div id="coop-success" class="success-message">
                    Liên Hệ Hợp Tác Của Bạn Đã Được Gửi Đến Bộ Phận Chăm Sóc Khách Hàng Của VACAMAXI
                </div>

                <form id="cooperation-form" class="cooperation-form">
                    <div class="form-group">
                        <input type="text" placeholder="Họ và Tên" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Gmail" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" placeholder="Số Điện Thoại" required>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Địa chỉ / Đơn vị (nếu có)">
                    </div>
                    <div class="form-group full-width">
                        <textarea rows="4" placeholder="Nội Dung Hợp Tác" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit-coop">GỬI THƯ</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('cooperation-form');
        const successMsg = document.getElementById('coop-success');

        if (form && successMsg) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                form.style.display = 'none';
                successMsg.style.display = 'block';
                successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        }
    });
</script>
@endpush
