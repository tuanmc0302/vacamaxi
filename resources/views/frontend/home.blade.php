<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>VACA MAXI</title>
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
            letter-spacing: 2px;
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
            margin-left: 6px;
        }

        .breeds-description {
            margin: 0;
            color: #1c1c1c;
            font-size: 16px;
            line-height: 1.35;
            letter-spacing: 1px;
            text-align: right;
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
    $frontendData = $frontendData ?? json_decode(file_get_contents(resource_path('data/frontend.json')), true) ?: [];
    $widgets = $widgets ?? collect();
    $productOptionItems = $productOptionItems ?? [];
    $nav = $frontendData['nav'] ?? [];
    $footer = $frontendData['footer'] ?? [];
    $active = 'home';
@endphp
@include('frontend.partials.header')
<main>
    @php
        $defaultWidgetOrder = collect([
            'banner_home',
            'about_me_home',
            'product_option_one',
            'about_team_home',
            'product_option_two',
            'product_option_three',
            'about_restaurant_home',
            'feedback_home',
            'news_home',
        ]);

        $widgetOrder = $widgets->isNotEmpty() ? $widgets->keys() : $defaultWidgetOrder;
        $widgetIncludes = [
            'banner_home' => ['view' => 'frontend.widgets.banner_home'],
            'about_me_home' => ['view' => 'frontend.widgets.about_me_home'],
            'product_option_one' => [
                'view' => 'frontend.widgets.product_option_one',
                'items' => $productOptionItems['product_option_one'] ?? $frontendData['breeds'] ?? [],
            ],
            'about_team_home' => ['view' => 'frontend.widgets.about_team_home'],
            'product_option_two' => [
                'view' => 'frontend.widgets.product_option_two',
                'items' => $productOptionItems['product_option_two'] ?? $frontendData['beefProducts'] ?? [],
            ],
            'product_option_three' => [
                'view' => 'frontend.widgets.product_option_three',
                'items' => $productOptionItems['product_option_three'] ?? $frontendData['wineProducts'] ?? [],
            ],
            'about_restaurant_home' => ['view' => 'frontend.widgets.about_restaurant_home'],
            'feedback_home' => ['view' => 'frontend.widgets.feedback_home'],
            'news_home' => [
                'view' => 'frontend.widgets.news_home',
                'news' => $frontendData['news'] ?? [],
            ],
        ];
    @endphp

    @foreach ($widgetOrder as $widgetKey)
        @continue(! isset($widgetIncludes[$widgetKey]))

        @php
            $includeConfig = $widgetIncludes[$widgetKey];
            $includeData = ['widget' => $widgets->get($widgetKey)] + collect($includeConfig)
                ->except('view')
                ->all();
        @endphp

        @include($includeConfig['view'], $includeData)
    @endforeach
</main>
@include('frontend.partials.footer')
@include('frontend.partials.floating-contact')
</body>
</html>
