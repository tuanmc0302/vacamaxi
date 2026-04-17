<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giới thiệu - VACA MAXI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --gold: #e7ab00;
            --dark: #210800;
        }

        body {
            margin: 0;
            color: #151515;
            font-family: Arial, Helvetica, sans-serif;
            background: #ffffff;
        }

        .site-header {
            background: rgba(16, 16, 16, 0.5);
            position: relative;
            z-index: 10;
            min-height: 78px;
        }

        .site-header .navbar {
            min-height: 78px;
            padding: 0;
        }

        .brand-logo {
            width: 170px;
            max-height: 58px;
            object-fit: contain;
        }

        .main-menu {
            gap: 22px;
        }

        .main-menu .nav-link {
            color: rgba(255, 255, 255, 0.86);
            font-size: 14px;
            letter-spacing: 0;
            padding: 0;
        }

        .main-menu .nav-link.active,
        .main-menu .nav-link:hover {
            color: var(--gold);
        }

        .intro-page {
            min-height: 575px;
            display: flex;
            align-items: center;
            padding: 88px 0 110px;
            background:
                linear-gradient(90deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 255, 255, 0.9) 50%, rgba(255, 255, 255, 0.98) 100%),
                url("/image/bg_gioithieu.png") center bottom / cover no-repeat;
        }

        .intro-panel {
            max-width: 780px;
            margin: 0 auto;
            text-align: center;
        }

        .eyebrow {
            margin: 0;
            color: var(--gold);
            font-size: 30px;
            font-style: italic;
            font-weight: 800;
            line-height: 1.05;
            text-transform: uppercase;
        }

        .intro-subtitle {
            margin-top: 4px;
            color: var(--gold);
            font-size: 13px;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .title-rule {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: -2px 0 20px;
        }

        .title-rule::before,
        .title-rule::after {
            content: "";
            height: 1px;
            background: var(--gold);
            flex: 1 1 0;
            max-width: 290px;
        }

        .title-rule span {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--gold);
            display: inline-block;
        }

        .intro-copy {
            max-width: 690px;
            margin: 0 auto;
            color: #111111;
            font-size: 13px;
            line-height: 1.95;
        }

        .intro-copy p {
            margin: 0 0 12px;
        }

        .site-footer {
            background: var(--dark);
            color: #ffffff;
            padding: 42px 0 34px;
        }

        .footer-logo {
            width: 175px;
            margin-bottom: 16px;
        }

        .footer-text,
        .footer-menu a,
        .footer-contact {
            color: rgba(255, 255, 255, 0.86);
            font-size: 13px;
            line-height: 1.7;
            text-decoration: none;
        }

        .footer-menu {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 9px;
        }

        .footer-menu a:hover {
            color: var(--gold);
        }

        .footer-heading {
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 12px;
            text-transform: uppercase;
        }

        .footer-map {
            height: 120px;
            border-radius: 7px;
            background: linear-gradient(135deg, #d8e3ed, #9fc2d6);
            color: #8a1c1c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
        }

        @media (max-width: 991.98px) {
            .site-header {
                background: #171717;
            }

            .main-menu {
                padding: 18px 0;
                gap: 14px;
            }

            .intro-page {
                min-height: auto;
                padding: 70px 0 86px;
            }
        }

        @media (max-width: 575.98px) {
            .brand-logo {
                width: 145px;
            }

            .eyebrow {
                font-size: 26px;
            }

            .intro-copy {
                font-size: 12px;
                line-height: 1.8;
            }
        }
    </style>
</head>

<body>
    @php
        $frontendData = json_decode(file_get_contents(resource_path('data/frontend.json')), true);
    @endphp
    @include('frontend.partials.header', ['active' => 'about', 'nav' => $frontendData['nav']])

    <main>
        <section class="intro-page" aria-labelledby="introTitle">
            <div class="container">
                <div class="intro-panel">
                    <h1 class="eyebrow" id="introTitle">Giới thiệu</h1>
                    <div class="intro-subtitle">Về VACA MAXI</div>
                    <div class="title-rule" aria-hidden="true"><span></span></div>
                    <div class="intro-copy">
                        <p>
                            VACA MAXI ra đời với khát vọng thay đổi cục diện ngành chăn nuôi Việt Nam. Trong bối cảnh
                            người tiêu dùng ngày càng đòi hỏi cao về chất lượng thịt bò, ngành chăn nuôi trong nước vẫn
                            còn nhiều hạn chế về giống, quy trình và năng suất. Với triết lý phát triển nông nghiệp chuẩn
                            cao, đồng hành cùng chuyên gia hàng đầu thế giới, VACA MAXI đã đặt lên móng một hệ sinh thái
                            chăn nuôi hiện đại, đồng bộ và bền vững. Không chỉ là nơi sản xuất bò giống, VACA MAXI còn là
                            trung tâm chuyển giao công nghệ, lan tỏa tri thức và ứng dụng giá trị cho nông dân Việt.
                        </p>
                        <p>
                            Song song với huyết thống bò giống và thịt bò cao cấp, VACA MAXI phát triển mảng rượu - kết
                            nối giá trị cuối giá trị trong nông nghiệp. Rượu Tăng Tâm Cốc là tinh hoa từ nông sản chọn
                            lọc, kết hợp với nghệ thuật chưng cất truyền thống, tạo nên loại rượu mang đậm bản sắc dân
                            tộc.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

        @include('frontend.partials.footer', ['footer' => $frontendData['footer'], 'nav' => $frontendData['nav']])

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


