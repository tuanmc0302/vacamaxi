@extends('frontend.master')

@php
    $pageTitle = 'Liên hệ - VACAMAXI';
    $metaDescription = 'Liên hệ với VACAMAXI để được tư vấn và hỗ trợ về các sản phẩm bò giống, thịt bò và dịch vụ nhà hàng.';
    $active = 'contact';
    $footer = $frontendData['footer'] ?? [];
@endphp

@push('styles')
    <style>
        .contact-page {
            padding: 80px 0;
            background: #fcfcfc;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 60px;
            align-items: start;
        }
        
        .contact-info h2 {
            font-size: 40px;
            font-weight: 800;
            color: #250900;
            margin-bottom: 30px;
            text-transform: uppercase;
        }
        .contact-info p {
            font-size: 16px;
            line-height: 1.8;
            color: #666;
            margin-bottom: 40px;
        }
        
        .contact-details {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        .contact-item {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .contact-icon {
            width: 50px;
            height: 50px;
            background: #250900;
            color: #f3b21a;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .contact-text h4 {
            font-size: 18px;
            font-weight: 700;
            color: #250900;
            margin-bottom: 5px;
        }
        .contact-text p {
            margin-bottom: 0;
            font-size: 15px;
        }

        /* Form Card Style (Reusing Cooperation Style) */
        .contact-form-card {
            background: #250900;
            border-radius: 30px;
            padding: 50px;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(37, 9, 0, 0.2);
        }
        .contact-form-card::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(243, 178, 26, 0.1) 0%, transparent 70%);
            z-index: 0;
        }
        .contact-form-header {
            margin-bottom: 35px;
            position: relative;
            z-index: 1;
        }
        .contact-form-header h3 {
            font-size: 32px;
            font-weight: 800;
            color: #f3b21a;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .contact-form-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 15px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            position: relative;
            z-index: 1;
        }
        .form-group.full-width {
            grid-column: span 2;
        }
        .form-grid input, .form-grid textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(243, 178, 26, 0.3);
            border-radius: 10px;
            padding: 15px 20px;
            color: #fff;
            outline: none;
            transition: all 0.3s;
        }
        .form-grid input:focus, .form-grid textarea:focus {
            border-color: #f3b21a;
            background: rgba(255, 255, 255, 0.1);
        }
        .form-grid input::placeholder, .form-grid textarea::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }
        .btn-send-contact {
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
        .btn-send-contact:hover {
            background: #ffc642;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .success-overlay {
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
            .contact-grid { grid-template-columns: 1fr; gap: 50px; }
            .contact-form-card { padding: 40px; }
        }
        @media (max-width: 575px) {
            .contact-info h2 { font-size: 32px; }
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full-width, .btn-send-contact { grid-column: span 1; }
            .contact-form-card { padding: 30px 20px; }
        }
    </style>
@endpush

@section('content')
    <section class="page-hero">
        <div class="container">
            <h1>LIÊN HỆ VỚI CHÚNG TÔI</h1>
            <p>Trang chủ / Liên hệ</p>
        </div>
    </section>

    <section class="contact-page">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2>KẾT NỐI CÙNG VACAMAXI</h2>
                    <p>Chúng tôi luôn sẵn sàng lắng nghe và giải đáp mọi thắc mắc của bạn. Hãy liên hệ với chúng tôi qua thông tin bên dưới hoặc để lại lời nhắn qua form liên hệ.</p>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Địa chỉ</h4>
                                <p>{{ $footer['address'] ?? '166 Phạm Văn Đồng, P. Đông Ngạc, TP. Hà Nội' }}</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Hotline</h4>
                                @foreach($footer['hotlines'] ?? [] as $phone)
                                    <p>{{ $phone }}</p>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Email</h4>
                                <p>{{ $footer['email'] ?? 'info@vacamaxi.vn' }}</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="bi bi-globe"></i>
                            </div>
                            <div class="contact-text">
                                <h4>Website</h4>
                                <p>{{ $footer['website'] ?? 'vacamaxi.vn' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form-card">
                    <div class="contact-form-header">
                        <h3>GỬI LỜI NHẮN</h3>
                        <p>Thông tin của bạn sẽ được bảo mật và phản hồi sớm nhất</p>
                    </div>

                    <div id="contact-success" class="success-overlay">
                        Liên Hệ Của Bạn Đã Được Gửi Đến Bộ Phận Chăm Sóc Khách Hàng Của VACAMAXI
                    </div>

                    <form id="contact-page-form" class="form-grid" action="{{ route('frontend.contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="full_name" placeholder="Họ và Tên" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Gmail">
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="Số Điện Thoại" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" placeholder="Tiêu đề">
                        </div>
                        <div class="form-group full-width">
                            <textarea name="content" rows="5" placeholder="Nội dung liên hệ" required></textarea>
                        </div>
                        <button type="submit" class="btn-send-contact" id="submit-btn">
                            <span class="btn-text">GỬI THƯ</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div style="width: 100%; height: 450px; background: #eee; position: relative; overflow: hidden;">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.1818296717523!2d105.78768827596956!3d21.065306586523963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135aad778f69795%3A0xb3e7104b2c866d5b!2zMTY2IFAuIFBo4bqhbSBWxINuIMSQ4buTbmcsIMSQw7RuZyBOZ-G6oWMsIELhuq9jIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1713580000000!5m2!1svi!2s" 
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contact-page-form');
        const successMsg = document.getElementById('contact-success');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const spinner = submitBtn.querySelector('.spinner-border');

        if (form && successMsg) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show loading
                submitBtn.disabled = true;
                btnText.textContent = 'ĐANG GỬI...';
                spinner.classList.remove('d-none');

                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    form.style.display = 'none';
                    successMsg.style.display = 'block';
                    successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra, vui lòng thử lại sau.');
                    submitBtn.disabled = false;
                    btnText.textContent = 'GỬI THƯ';
                    spinner.classList.add('d-none');
                });
            });
        }
    });
</script>
@endpush
