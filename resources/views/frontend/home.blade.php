<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
        body {
            margin: 0;
            background: #ffffff;
            font-family: Arial, Helvetica, sans-serif;
        }
        .site-header .navbar .nav-link {
    color: #fff;
    font-weight: 500;
}

.site-header .navbar .nav-link.active {
    color: #d4a24c;
}

.site-header .dropdown-menu {
    border: 0;
    border-radius: 12px;
    padding: 8px 0;
    min-width: 220px;
    box-shadow: 0 10px 30px rgba(0,0,0,.12);
}

.site-header .dropdown-item {
    padding: 10px 18px;
    font-size: 15px;
}

.site-header .dropdown-item.active,
.site-header .dropdown-item:active {
    background: rgba(212, 162, 76, 0.12);
    color: #d4a24c;
}

@media (min-width: 992px) {
    .site-header .nav-item.dropdown:hover .dropdown-menu {
        display: block;
        margin-top: 0;
    }
}

        .site-header {
            background: rgba(16, 16, 16, 0.47);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
            display: flex;
            align-items: center;
        }

        .site-header .navbar {
            padding: 0;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 0;
            color: #ffffff;
            letter-spacing: 0;
            text-decoration: none;
            white-space: nowrap;
        }

        .brand-mark {
            width: 170px;
            max-height: 58px;
            height: auto;
            display: block;
        }

        .main-menu {
            gap: 22px;
        }

        .main-menu .nav-link {
            color: #e6e6e6;
            font-size: 15px;
            line-height: 1;
            padding: 0;
            letter-spacing: 0;
        }

        .main-menu .nav-link:hover,
        .main-menu .nav-link:focus,
        .main-menu .nav-link.active {
            color: #ffd200;
        }

        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.35);
            border-radius: 4px;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        .hero-banner {
            height: 100vh;
            display: flex;
            align-items: center;
            color: #ffffff;
            background-image:
                linear-gradient(90deg, rgba(0, 0, 0, 0.72) 0%, rgba(0, 0, 0, 0.42) 40%, rgba(0, 0, 0, 0.08) 100%),
                url("/image/banner.png");
            background-size: cover;
            background-position: center;
            padding: 160px 0 110px;
        }

        .hero-content {
            max-width: 470px;
        }

        .hero-eyebrow {
            margin: 0 0 10px;
            color: #f2f2f2;
            font-size: 17px;
            line-height: 1.4;
            letter-spacing: 0;
        }

        .hero-title {
            margin: 0;
            color: #ffffff;
            font-size: 34px;
            font-weight: 700;
            line-height: 1.16;
            letter-spacing: 0;
        }

        .hero-copy {
            margin: 12px 0 22px;
            color: rgba(255, 255, 255, 0.82);
            font-size: 13px;
            line-height: 1.5;
            letter-spacing: 0;
        }

        .hero-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 148px;
            min-height: 36px;
            padding: 9px 18px;
            border-radius: 6px;
            background: #f4b000;
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: 0;
            text-decoration: none;
        }

        .hero-action:hover,
        .hero-action:focus {
            color: #ffffff;
            background: #d99c00;
        }

        .about-section {
            position: relative;
            overflow: hidden;
            padding: 110px 0;
            background:
                linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)),
                url("/image/bg_about.png");
            background-size: cover;
            background-position: center;
        }

        .about-section .container {
            position: relative;
            z-index: 1;
        }

        .about-gallery {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .about-photo {
            width: 100%;
            aspect-ratio: 1.06;
            object-fit: cover;
            display: block;
            border-radius: 8px;
            box-shadow: 0 12px 26px rgba(0, 0, 0, 0.18);
        }

        .about-photo:nth-child(1) {
            height: 100%;
        }

        .about-photo:nth-child(2) {
            margin-top: 32px;
        }

        .about-photo:nth-child(3) {
            margin-bottom: 32px;
        }

        .about-photo:nth-child(4) {
            height: 100%;
        }

        .about-content {
            max-width: 690px;
            padding-left: 28px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            margin-bottom: 22px;
        }

        .section-heading h2 {
            margin: 0;
            color: #e7a900;
            font-size: 34px;
            font-weight: 400;
            line-height: 1;
            letter-spacing: 4px;
            white-space: nowrap;
        }

        .section-heading span {
            width: 100%;
            height: 1px;
            background: #e7a900;
            display: block;
            margin-top: auto;
            margin-bottom: 5px;
        }

        .section-heading span::after {
            content: "";
            display: block;
            width: 5px;
            height: 5px;
            margin-left: auto;
            margin-top: -2px;
            border-radius: 50%;
            background: #e7a900;
        }

        .about-text {
            margin: 0 0 26px;
            color: #1d1d1d;
            font-size: 16px;
            line-height: 1.8;
            letter-spacing: 0.3px;
        }

        .about-text strong {
            font-weight: 700;
        }

        .about-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 206px;
            min-height: 42px;
            padding: 11px 24px;
            border-radius: 8px;
            background: #f3b21a;
            color: #ffffff;
            font-size: 18px;
            line-height: 1;
            letter-spacing: 0;
            text-decoration: none;
        }

        .about-action:hover,
        .about-action:focus {
            color: #ffffff;
            background: #d99c00;
        }

        .breeds-section {
            padding: 66px 0 74px;
            background: #ffffff;
            color: #1c1c1c;
        }

        .breeds-intro {
            margin-bottom: 88px;
        }

        .breeds-kicker {
            margin: 0 0 8px;
            color: #1c1c1c;
            font-size: 22px;
            line-height: 1.1;
            text-transform: uppercase;
        }

        .breeds-title {
            margin: 0;
            color: #111111;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.1;
            text-transform: uppercase;
        }

        .breeds-title span {
            color: #e7a900;
        }

        .breeds-description {
            max-width: 680px;
            margin: 0;
            color: #1c1c1c;
            font-size: 16px;
            line-height: 1.35;
            letter-spacing: 1px;
        }

        .breed-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .breed-card {
            padding: 20px 10px 0;
            overflow: hidden;
            min-height: 296px;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 8px 14px rgba(0, 0, 0, 0.24);
        }

        .breed-card img {
            width: 100%;
            aspect-ratio: 269 / 154;
            object-fit: cover;
            display: block;
        }

        .breed-card-body {
            display: flex;
            min-height: 142px;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 8px 22px 14px;
            text-align: center;
        }

        .breed-card h3 {
            margin: 0;
            color: #111111;
            font-size: 24px;
            font-weight: 700;
            line-height: 1.15;
            letter-spacing: 0;
        }

        .breed-card p {
            margin: 16px 0 12px;
            color: #111111;
            font-size: 12px;
            line-height: 1.25;
            letter-spacing: 0.5px;
        }

        .breed-link {
            color: #111111;
            font-size: 12px;
            line-height: 1;
            letter-spacing: 0.8px;
            text-decoration: none;
            text-transform: uppercase;
        }

        .breed-link:hover,
        .breed-link:focus {
            color: #e7a900;
        }

        .breeds-more {
            display: flex;
            justify-content: center;
            margin-top: 34px;
        }

        .breeds-more .about-action {
            min-width: 206px;
            text-transform: uppercase;
        }

        .expert-section {
            padding: 70px 0 62px;
            background: #ffffff;
            color: #1c1c1c;
        }

        .expert-content {
            max-width: 660px;
        }

        .expert-title {
            display: flex;
            align-items: flex-end;
            gap: 12px;
            margin-bottom: 30px;
        }

        .expert-title h2 {
            margin: 0;
            color: #e7a900;
            font-size: 40px;
            font-weight: 400;
            line-height: 1.18;
            text-transform: uppercase;
        }

        .expert-title span {
            flex: 1;
            min-width: 120px;
            height: 1px;
            margin-bottom: 10px;
            background: #e7a900;
        }

        .expert-title span::after {
            content: "";
            display: block;
            width: 5px;
            height: 5px;
            margin-left: auto;
            margin-top: -2px;
            border-radius: 50%;
            background: #e7a900;
        }

        .expert-lead {
            margin: 0 0 8px;
            color: #111111;
            font-size: 17px;
            font-weight: 700;
            line-height: 1.5;
        }

        .expert-text {
            margin: 0 0 32px;
            color: #1c1c1c;
            font-size: 17px;
            line-height: 1.78;
            letter-spacing: 0.4px;
        }

        .expert-gallery {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .expert-gallery img {
            width: 100%;
            aspect-ratio: 269 / 154;
            object-fit: cover;
            display: block;
            border-radius: 8px;
            box-shadow: 0 8px 14px rgba(0, 0, 0, 0.2);
        }

        .product-section {
            padding: 66px 0 52px;
            background: #ffffff;
            color: #1c1c1c;
        }

        .product-section + .product-section {
            padding-top: 48px;
        }

        .product-title {
            margin: 0;
            color: #111111;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .product-title span {
            color: #e7a900;
        }

        .product-card {
            min-height: 294px;
        }

        .product-card .breed-card-body {
            min-height: 140px;
            padding-top: 9px;
        }

        .restaurant-section {
            padding: 44px 0 58px;
            background: #ffffff;
            color: #111111;
        }

        .restaurant-heading {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 5px;
        }

        .restaurant-heading h2 {
            margin: 0;
            color: #e7a900;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: 1px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .restaurant-heading span {
            width: 100%;
            max-width: 100%;
            height: 1px;
            background: #e7a900;
            margin-bottom: -16px;
        }

        .restaurant-heading span::after {
            content: "";
            display: block;
            width: 5px;
            height: 5px;
            margin-left: auto;
            margin-top: -2px;
            border-radius: 50%;
            background: #e7a900;
        }

        .restaurant-copy {
            max-width: 780px;
            margin: 0 0 30px;
            color: #1c1c1c;
            font-size: 16px;
            line-height: 1.35;
            letter-spacing: 1px;
        }

        .restaurant-gallery {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 8px;
            align-items: stretch;
        }

        .restaurant-gallery img {
            width: 100%;
            height: 100%;
            display: block;
            border-radius: 16px;
        }

        .restaurant-dots {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            margin-top: 18px;
        }

        .restaurant-dots i {
            width: 12px;
            height: 12px;
            display: block;
            transform: rotate(45deg);
            background: #e7a900;
        }

        .restaurant-dots span {
            width: 82px;
            height: 1px;
            display: block;
            background: #e7a900;
        }

        .testimonial-section {
            padding: 44px 0 36px;
            color: #ffffff;
            background-image: url("/image/bg_feedback.png");
            background-size: cover;
            background-position: center;
        }

        .testimonial-heading {
            margin-bottom: 34px;
            text-align: center;
        }

        .testimonial-heading h2 {
            margin: 0;
            color: #ffffff;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .testimonial-heading p {
            margin: 3px 0 0;
            color: #ffffff;
            font-size: 22px;
            line-height: 1.2;
            letter-spacing: 0.5px;
        }

        .testimonial-main{
            display: grid;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .testimonial-wrap {
            max-width: 980px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 26px;
        }

        .testimonial-card {
            position: relative;
            min-height: 106px;
            padding: 18px 28px;
            border-radius: 6px;
            background: rgba(0, 0, 0, 0.52);
        }

        .testimonial-avatar {
            top: 14px;
            left: 18px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .testimonial-role {
            margin: 0;
            color: #ffffff;
            font-size: 11px;
            line-height: 1.1;
            letter-spacing: 0;
        }

        .testimonial-name {
            margin: 2px 0 10px;
            color: #f3b21a;
            font-size: 18px;
            line-height: 1.1;
            letter-spacing: 0;
        }

        .testimonial-text {
            margin: 0;
            color: #ffffff;
            font-size: 20px;
            line-height: 1.28;
            letter-spacing: 0.3px;
        }

        .testimonial-quote {
            position: absolute;
            top: -10px;
            right: 18px;
            color: #ffffff;
            font-size: 44px;
            font-weight: 700;
            line-height: 1;
        }

        .site-footer {
            padding: 34px 0 42px;
            background: #2b0d00;
            color: #ffffff;
        }

        .footer-logo {
            width: 160px;
            height: auto;
            display: block;
            margin-bottom: 18px;
        }

        .footer-about {
            margin: 0 0 18px;
            color: rgba(255, 255, 255, 0.86);
            font-size: 12px;
            line-height: 1.36;
            letter-spacing: 0.7px;
        }

        .footer-contact {
            display: grid;
            gap: 10px;
            color: #ffffff;
            font-size: 12px;
            line-height: 1.2;
            letter-spacing: 0.3px;
        }

        .footer-contact p {
            margin: 0;
        }

        .footer-menu {
            display: grid;
            gap: 8px;
            padding: 0;
            list-style: none;
        }

        .footer-menu a {
            color: #ffffff;
            font-size: 12px;
            line-height: 1;
            letter-spacing: 0.4px;
            text-decoration: none;
        }

        .footer-menu a:hover,
        .footer-menu a:focus {
            color: #f3b21a;
        }

        .footer-map {
            position: relative;
            overflow: hidden;
            width: 100%;
            min-height: 122px;
            border-radius: 8px;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.92), rgba(209, 236, 247, 0.92)),
                repeating-linear-gradient(45deg, transparent 0 24px, rgba(140, 160, 170, 0.25) 24px 27px);
        }

        .footer-map::before {
            content: "Vaca Maxi restaurant";
            position: absolute;
            top: 16px;
            left: 20px;
            color: #333333;
            font-size: 12px;
            font-weight: 700;
        }

        .footer-map::after {
            content: "";
            position: absolute;
            top: 42px;
            left: 50%;
            width: 16px;
            height: 16px;
            border-radius: 50% 50% 50% 0;
            background: #e04848;
            transform: rotate(-45deg);
        }

        .footer-social-title {
            margin: 18px 0 10px;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .footer-social {
            display: flex;
            gap: 14px;
        }

        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 4px;
            background: #ffffff;
            color: #2454d6;
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
            text-decoration: none;
        }

        .footer-social a:nth-child(3) {
            color: #e21d1d;
        }

        .news-section {
            padding: 54px 0 44px;
            background: #ffffff;
            color: #111111;
        }

        .news-intro {
            margin-bottom: 64px;
        }

        .news-kicker {
            margin: 0 0 4px;
            color: #111111;
            font-size: 17px;
            line-height: 1.1;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .news-title {
            margin: 0;
            color: #111111;
            font-size: 30px;
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .news-title span {
            color: #e7a900;
        }

        .news-description {
            max-width: 620px;
            margin: 0;
            color: #111111;
            font-size: 17px;
            line-height: 1.35;
            letter-spacing: 0.6px;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 22px 10px;
        }

        .news-card {
            padding: 16px 12px;
            overflow: hidden;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.22);
        }

        .news-card img {
            width: 100%;
            aspect-ratio: 269 / 124;
            object-fit: cover;
            display: block;
        }

        .news-card-body {
            padding: 9px 2px 2px;
        }

        .news-card h3 {
            margin: 0 0 6px;
            color: #111111;
            font-size: 19px;
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: 0;
        }

        .news-card p {
            margin: 0 0 12px;
            color: #111111;
            font-size: 12px;
            line-height: 1.35;
            letter-spacing: 0.2px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            color: #111111;
            font-size: 11px;
            line-height: 1;
        }

        .news-meta a {
            color: #111111;
            font-weight: 700;
            letter-spacing: 0;
            text-decoration: none;
        }

        .news-meta a:hover,
        .news-meta a:focus {
            color: #e7a900;
        }

        .news-more {
            display: flex;
            justify-content: center;
            margin-top: 48px;
        }

        @media (max-width: 991.98px) {
            .site-header {
                min-height: auto;
                padding: 14px 0;
            }

            .site-header .navbar {
                min-height: auto;
            }

            .main-menu {
                gap: 16px;
                padding-top: 18px;
            }

            .hero-banner {
                min-height: 520px;
                padding: 140px 0 70px;
                background-position: center;
            }

            .hero-title {
                font-size: 30px;
            }

            .about-section {
                padding: 80px 0;
            }


            .about-content {
                max-width: none;
                padding-left: 0;
                padding-top: 36px;
            }

            .section-heading h2 {
                font-size: 30px;
            }

            .breeds-section {
                padding: 62px 0;
            }

            .breeds-intro {
                margin-bottom: 42px;
            }

            .breeds-description {
                max-width: none;
                margin-top: 24px;
                font-size: 19px;
            }

            .breed-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }

            .expert-title h2,
            .product-title {
                font-size: 30px;
            }

            .expert-gallery {
                margin-top: 34px;
            }

            .restaurant-gallery {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .testimonial-wrap {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .footer-menu {
                margin-top: 28px;
                gap: 14px;
            }

            .footer-map {
                margin-top: 30px;
            }

            .news-intro {
                margin-bottom: 34px;
            }

            .news-description {
                max-width: none;
                margin-top: 22px;
            }

            .news-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }
        }

        @media (max-width: 575.98px) {
            .brand-mark {
                width: 140px;
            }

            .hero-banner {
                min-height: 560px;
                padding: 130px 0 58px;
                background-position: center;
            }

            .hero-title {
                font-size: 28px;
            }

            .hero-copy {
                font-size: 13px;
            }

            .about-section {
                padding: 58px 0;
            }

            .about-gallery {
                gap: 8px;
            }

            .about-photo:nth-child(2),
            .about-photo:nth-child(4) {
                margin-top: 0;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }

            .section-heading h2 {
                font-size: 27px;
                white-space: normal;
            }

            .section-heading span {
                max-width: 100%;
            }

            .about-text {
                font-size: 14px;
                line-height: 1.75;
            }

            .about-action {
                min-width: 180px;
                font-size: 16px;
            }

            .breeds-section {
                padding: 48px 0;
            }

            .breeds-kicker {
                font-size: 18px;
            }

            .breeds-title {
                font-size: 27px;
            }

            .breeds-description {
                font-size: 16px;
                line-height: 1.5;
            }

            .breed-grid {
                grid-template-columns: 1fr;
            }

            .breed-card {
                min-height: auto;
            }

            .expert-section,
            .product-section {
                padding: 48px 0;
            }

            .expert-title {
                align-items: flex-start;
                flex-direction: column;
                gap: 14px;
            }

            .expert-title h2,
            .product-title {
                font-size: 27px;
                letter-spacing: 2px;
            }

            .expert-title span {
                width: 100%;
            }

            .expert-text {
                font-size: 15px;
                line-height: 1.7;
            }

            .expert-gallery {
                grid-template-columns: 1fr;
            }

            .restaurant-section {
                padding: 38px 0 46px;
            }

            .restaurant-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .restaurant-heading span {
                width: 100%;
            }

            .restaurant-gallery {
                grid-template-columns: 1fr;
            }

            .testimonial-section {
                padding: 38px 0 34px;
            }

            .testimonial-card {
                padding-right: 18px;
            }

            .news-section {
                padding: 42px 0;
            }

            .news-title {
                font-size: 27px;
            }

            .news-description {
                font-size: 15px;
            }

            .news-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    @php
        $frontendData = json_decode(file_get_contents(resource_path('data/frontend.json')), true);
    @endphp
    @include('frontend.partials.header', ['active' => 'home', 'nav' => $frontendData['nav']])
    <main>
        <section class="hero-banner">
            <div class="container">
                <div class="hero-content">
                    <p class="hero-eyebrow">NhÃ  hÃ ng 5 sao Vaca Maxi</p>
                    <h1 class="hero-title">VACA MAXI lÃ  nhÃ  hÃ ng steak &amp; grill cao cáº¥p</h1>
                    <p class="hero-copy">NÆ¡i áº©m thá»±c khÃ´ng chá»‰ Ä‘Æ°á»£c thÆ°á»Ÿng thá»©c báº±ng vá»‹ giÃ¡c, mÃ  cÃ²n Ä‘Æ°á»£c cáº£m nháº­n báº±ng tháº©m má»¹, khÃ´ng gian vÃ  chiá»u sÃ¢u cá»§a cÃ¢u chuyá»‡n phÃ­a sau má»—i lá»±a chá»n.</p>
                    <a class="hero-action" href="#">KHÃM PHÃ NGAY</a>
                </div>
            </div>
        </section>
        <section class="about-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5">
                        <div class="about-gallery">
                            <img class="about-photo" src="/image/Rectangle%202.png" alt="BÃ² giá»‘ng VACA MAXI">
                            <img class="about-photo" src="/image/Rectangle%203.png" alt="Thá»‹t bÃ² cháº¥t lÆ°á»£ng cao">
                            <img class="about-photo" src="/image/Rectangle%204.png" alt="RÆ°á»£u vÃ  mÃ³n Äƒn táº¡i VACA MAXI">
                            <img class="about-photo" src="/image/Rectangle%205.png" alt="KhÃ´ng gian nhÃ  hÃ ng VACA MAXI">
                        </div>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="about-content">
                            <div class="section-heading">
                                <h2>Vá»€ VACA MAXI</h2>
                                <span></span>
                            </div>
                            <p class="about-text"><strong>VACA MAXI</strong> tiÃªn phong kiáº¿n táº¡o há»‡ sinh thÃ¡i chÄƒn nuÃ´i cÃ´ng nghá»‡ cao táº¡i Viá»‡t Nam. Há»£p tÃ¡c cÃ¹ng chuyÃªn gia hÃ ng Ä‘áº§u Argentina, chÃºng tÃ´i phÃ¡t triá»ƒn bÃ² giá»‘ng vÃ  thá»‹t bÃ² cháº¥t lÆ°á»£ng cao theo chuáº©n quá»‘c táº¿. Má»Ÿ rá»™ng chuá»—i giÃ¡ trá»‹ vá»›i rÆ°á»£u cao cáº¥p vÃ  nhÃ  hÃ ng tinh tuyá»ƒn, VACA MAXI mang Ä‘áº¿n giÃ¡ trá»‹ bá»n vá»¯ng vÃ  tráº£i nghiá»‡m Ä‘áº³ng cáº¥p.</p>
                            <a class="about-action" href="#">TÃ¬m hiá»ƒu thÃªm</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="breeds-section">
            <div class="container">
                <div class="row breeds-intro align-items-start">
                    <div class="col-lg-6">
                        <p class="breeds-kicker">GIá»NG BÃ’ Cá»¦A CHÃšNG TÃ”I</p>
                        <h2 class="breeds-title"><span>CÃC GIá»NG BÃ’</span> VACA MAXI</h2>
                    </div>
                    <div class="col-lg-6">
                        <p class="breeds-description">Má»—i giá»‘ng bÃ² táº¡i VACA MAXI lÃ  káº¿t quáº£ cá»§a quÃ¡ trÃ¬nh chá»n lá»c vÃ  phÃ¡t triá»ƒn di truyá»n nghiÃªm ngáº·t, Ä‘áº£m báº£o nÄƒng xuáº¥t vÃ  cháº¥t lÆ°á»£ng vÆ°á»£t trá»™i</p>
                    </div>
                </div>
                <div class="breed-grid">
                    @foreach ($frontendData['breeds'] as $item)
                        @include('frontend.components.product-card', ['item' => $item, 'class' => 'breed-card'])
                    @endforeach
                </div>
                <div class="breeds-more">
                    <a class="about-action" href="#">XEM THÃŠM</a>
                </div>
            </div>
        </section>
        <section class="expert-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-12">
                        <div class="expert-content">
                            <div class="expert-title">
                                <h2>Äá»˜I NGÅ¨ CHUYÃŠN GIA Cá»¦A VACA MAXI</h2>
                                <span></span>
                            </div>
                            <p class="expert-lead">Há»£p tÃ¡c giá»¯a Vaca Maxi vÃ  chuyÃªn gia Argentina</p>
                            <p class="expert-text">Há»‡ thá»‘ng sáº£n xuáº¥t chÄƒn nuÃ´i Ä‘Æ°á»£c thiáº¿t káº¿ vÃ  triá»ƒn khai bá»Ÿi Ä‘á»™i ngÅ© chuyÃªn gia hÃ ng Ä‘áº§u tháº¿ giá»›i. CÃ¡c chuyÃªn gia cÃ³ chuyÃªn mÃ´n vá» dinh dÆ°á»¡ng Ä‘á»™ng váº­t, sá»©c khá»e bÃ² vÃ  cháº¥t lÆ°á»£ng thá»‹t, chá»‹u trÃ¡ch nhiá»‡m giÃ¡m sÃ¡t toÃ n bá»™ quy trÃ¬nh â€” tá»« cháº©n Ä‘oÃ¡n thai ká»³, sinh sáº£n, Ä‘áº¿n giai Ä‘oáº¡n vá»— bÃ©o vÃ  láº¥y thá»‹t. Nhá»¯ng chuyÃªn gia nÃ y khÃ´ng chá»‰ dáº«n Ä‘áº§u táº¡i Argentina mÃ  cÃ²n Ä‘Æ°á»£c cÃ´ng nháº­n trÃªn toÃ n tháº¿ giá»›i, liÃªn tá»¥c tÆ° váº¥n vÃ  chuyá»ƒn giao cÃ´ng nghá»‡ cho cÃ¡c quá»‘c gia cÃ³ ná»n chÄƒn nuÃ´i tiÃªn tiáº¿n</p>
                            <a class="about-action" href="#">TÃ¬m hiá»ƒu thÃªm</a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="about-gallery">
                            <img class="about-photo" src="/image/Rectangle%202.png" alt="BÃ² giá»‘ng VACA MAXI">
                            <img class="about-photo" src="/image/Rectangle%203.png" alt="Thá»‹t bÃ² cháº¥t lÆ°á»£ng cao">
                            <img class="about-photo" src="/image/Rectangle%204.png" alt="RÆ°á»£u vÃ  mÃ³n Äƒn táº¡i VACA MAXI">
                            <img class="about-photo" src="/image/Rectangle%205.png" alt="KhÃ´ng gian nhÃ  hÃ ng VACA MAXI">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-section">
            <div class="container">
                <div class="row breeds-intro align-items-start">
                    <div class="col-lg-6">
                        <p class="breeds-kicker">Sáº¢N PHáº¨M Vá»€ THá»ŠT BÃ’</p>
                        <h2 class="product-title">CHáº¤T LÆ¯á»¢NG THá»ŠT BÃ’ <span>VACA MAXI</span></h2>
                    </div>
                    <div class="col-lg-6">
                        <p class="breeds-description">Má»—i giá»‘ng bÃ² táº¡i VACA MAXI lÃ  káº¿t quáº£ cá»§a quÃ¡ trÃ¬nh chá»n lá»c vÃ  phÃ¡t triá»ƒn di truyá»n nghiÃªm ngáº·t, Ä‘áº£m báº£o nÄƒng xuáº¥t vÃ  cháº¥t lÆ°á»£ng vÆ°á»£t trá»™i</p>
                    </div>
                </div>
                <div class="breed-grid">
                    @foreach ($frontendData['beefProducts'] as $item)
                        @include('frontend.components.product-card', ['item' => $item, 'class' => 'breed-card product-card'])
                    @endforeach
                </div>
                <div class="breeds-more">
                    <a class="about-action" href="#">XEM THÃŠM</a>
                </div>
            </div>
        </section>
        <section class="product-section">
            <div class="container">
                <div class="row breeds-intro align-items-start">
                    <div class="col-lg-6">
                        <p class="breeds-kicker">TINH HOA NÃ”NG NGHIá»†P</p>
                        <h2 class="product-title"><span>Sáº¢N PHáº¨M RÆ¯á»¢U</span> VACA MAXI</h2>
                    </div>
                    <div class="col-lg-6">
                        <p class="breeds-description">RÆ°á»£u truyá»n thá»‘ng do VACA MAXI phÃ¡t triá»ƒn Ä‘Æ°á»£c náº¥u tá»« 3 loáº¡i ngÅ© cá»‘c quen thuá»™c vá»›i ngÆ°á»i Viá»‡t</p>
                    </div>
                </div>
                <div class="breed-grid">
                    @foreach ($frontendData['wineProducts'] as $item)
                        @include('frontend.components.product-card', ['item' => $item, 'class' => 'breed-card product-card'])
                    @endforeach
                </div>
                <div class="breeds-more">
                    <a class="about-action" href="#">XEM THÃŠM</a>
                </div>
            </div>
        </section>
        <section class="restaurant-section">
            <div class="container">
                <div class="restaurant-heading">
                    <h2>NHÃ€ HÃ€NG 5 SAO VACA MAXI</h2>
                    <span></span>
                </div>
                <p class="restaurant-copy">NÆ¡i áº©m thá»±c khÃ´ng chá»‰ Ä‘Æ°á»£c thÆ°á»Ÿng thá»©c báº±ng vá»‹ giÃ¡c, mÃ  cÃ²n Ä‘Æ°á»£c cáº£m nháº­n báº±ng tháº©m má»¹, khÃ´ng gian vÃ  chiá»u sÃ¢u cá»§a cÃ¢u chuyá»‡n phÃ­a sau má»—i lá»±a chá»n.</p>
                <div class="restaurant-gallery">
                    <img src="/image/Rectangle%202.png" alt="KhÃ´ng gian nhÃ  hÃ ng VACA MAXI">
                    <img src="/image/Rectangle%203.png" alt="MÃ³n steak VACA MAXI">
                    <img src="/image/Rectangle%204.png" alt="KhÃ´ng gian thÆ°á»Ÿng thá»©c VACA MAXI">
                    <img src="/image/Rectangle%205.png" alt="MÃ³n nÆ°á»›ng VACA MAXI">
                </div>
                <div class="restaurant-dots" aria-hidden="true">
                    <i></i>
                    <i></i>
                    <i></i>
                    <span></span>
                    <i></i>
                </div>
            </div>
        </section>
        <section class="testimonial-section">
            <div class="container">
                <div class="testimonial-heading">
                    <h2>ÄÃNH GIÃ Cá»¦A KHÃCH HÃ€NG</h2>
                    <p>trÃªn Google Maps</p>
                </div>
                <div class="container">
                    <div class="testimonial-main">
                        <article class="testimonial-card">
                            <div class="d-flex gap-3 mt-3 align-items-center">
                                <img class="testimonial-avatar" src="/image/Rectangle%202.png" alt="HoÃ ng Trang">
                                <div class="testimonial-item">
                                    <p class="testimonial-role mt-1">KhÃ¡ch hÃ ng</p>
                                <h3 class="testimonial-name mt-1 mb-0">HoÃ ng Trang</h3>
                                </div>
                                
                            </div>
                            <p class="testimonial-text mt-3">â€œThá»‹t bÃ² Vacamax tháº­t sá»± cháº¥t lÆ°á»£ng! BÃ² má»m, tÆ°Æ¡i vÃ  Ä‘Æ°á»£c nÃªm náº¿m ráº¥t vá»«a miá»‡ng. MÃ¬nh thÃ­ch nháº¥t lÃ  cÃ¡c mÃ³n bÃ² nÆ°á»›ng vÃ  bÃ² sá»‘t, Äƒn khÃ´ng bá»‹ ngáº¥yâ€</p>
                            <span class="testimonial-quote">â€</span>
                        </article>
                        <article class="testimonial-card">
                            <div class="d-flex gap-3 mt-3 align-items-center">
                                <img class="testimonial-avatar" src="/image/Rectangle%203.png" alt="TÃ¹ng phan">
                                <div class="testimonial-item">
                                    <p class="testimonial-role mt-1">KhÃ¡ch hÃ ng</p>
                                    <h3 class="testimonial-name mt-1 mb-0">TÃ¹ng phan</h3>
                                </div>
                            </div>
                            <p class="testimonial-text mt-3">â€œÄÃºng chuáº©n quÃ¡n bÃ² cho ngÆ°á»i mÃª thá»‹t. Pháº§n Äƒn Ä‘áº§y Ä‘áº·n, giÃ¡ cáº£ há»£p lÃ½ so vá»›i cháº¥t lÆ°á»£ng. NhÃ¢n viÃªn thÃ¢n thiá»‡n, tÆ° váº¥n mÃ³n ráº¥t cÃ³ tÃ¢m. Äi nhÃ³m báº¡n hay gia Ä‘Ã¬nh Ä‘á»u há»£pâ€</p>
                            <span class="testimonial-quote">â€</span>
                        </article>
                    </div>
                </div>
                <div class="restaurant-dots" aria-hidden="true">
                    <i></i>
                    <i></i>
                    <i></i>
                    <span></span>
                    <i></i>
                </div>
            </div>
        </section>
    </main>
    <section class="news-section">
        <div class="container">
            <div class="row news-intro align-items-start">
                <div class="col-lg-6">
                    <p class="news-kicker">TIN Tá»¨C Má»šI NHáº¤T</p>
                    <h2 class="news-title">GÃ“C NHÃŒN &amp; <span>XU HÆ¯á»šNG</span></h2>
                </div>
                <div class="col-lg-6">
                    <p class="news-description">Tin Tá»©c Má»›i Nháº¥t â€“ GÃ³c NhÃ¬n Tá»« NÃ´ng Nghiá»‡p Bá»n Vá»¯ng Äáº¿n NhÃ  HÃ ng Hiá»‡n Äáº¡i, Káº¿t Ná»‘i VÄƒn HÃ³a áº¨m Thá»±c VÃ  Nhá»¯ng Xu HÆ°á»›ng RÆ°á»£u Äang Äá»‹nh HÃ¬nh Thá»‹ TrÆ°á»ng</p>
                </div>
            </div>
            <div class="news-grid">
                    @foreach ($frontendData['news'] as $item)
                        @include('frontend.components.news-card', ['item' => $item])
                    @endforeach
                </div>
                <div class="news-more">
                <a class="about-action" href="/tin-tuc/ruou-trang-tam-coc">XEM THÃŠM</a>
            </div>
        </div>
    </section>
        @include('frontend.partials.footer', ['footer' => $frontendData['footer'], 'nav' => $frontendData['nav']])
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>

