<style>
    .site-header {
        position: absolute;
        inset: 0 0 auto;
        z-index: 10;
        min-height: 54px;
        background: rgba(0, 0, 0, 0.62);
    }

    .site-header .navbar {
        min-height: 54px;
        padding: 0;
    }

    .brand-link,
    .brand-logo,
    .brand-mark {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
    }

    .brand-mark,
    .brand-logo {
        width: 116px;
        max-height: 42px;
        object-fit: contain;
    }

    .site-header .nav-link {
        color: #ffffff;
        font-size: 12px;
        font-weight: 500;
        padding: 0 7px;
    }

    .site-header .nav-link.active,
    .site-header .nav-link:hover,
    .site-header .nav-link:focus {
        color: #e7a900;
    }

    .site-header .dropdown-menu {
        border: 0;
        border-radius: 8px;
        padding: 8px 0;
        min-width: 220px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
    }

    .site-header .dropdown-item {
        padding: 10px 18px;
        font-size: 14px;
    }

    .site-header .dropdown-item.active,
    .site-header .dropdown-item:active {
        color: #e7a900;
        background: rgba(231, 169, 0, 0.12);
    }

    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.35);
        border-radius: 4px;
    }

    .navbar-toggler-icon {
        filter: invert(1);
    }

    @media (min-width: 992px) {
        .site-header .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
    }

    .site-footer {
        padding: 46px 0 42px;
        color: #ffffff;
        background: #250900;
    }

    .footer-logo {
        width: 180px;
        max-height: 68px;
        object-fit: contain;
        margin-bottom: 15px;
    }

    .footer-about,
    .footer-contact p {
        max-width: 420px;
        margin: 0 0 10px;
        font-size: 14px;
        line-height: 1.55;
    }

    .footer-menu {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .footer-menu li {
        margin-bottom: 13px;
    }

    .footer-menu a {
        color: #ffffff;
        font-size: 14px;
        text-decoration: none;
    }

    .footer-map {
        width: 100%;
        min-height: 120px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.82);
        margin-bottom: 18px;
    }

    .footer-social-title {
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .footer-social {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .footer-social a {
        min-width: 36px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        color: #0b4fe8;
        background: #ffffff;
        font-size: 12px;
        text-decoration: none;
    }

    .float-contact {
        position: fixed;
        right: 0;
        top: 50%;
        z-index: 20;
        width: 58px;
        padding: 18px 0;
        display: grid;
        gap: 16px;
        border-radius: 34px 0 0 34px;
        background: #f8c446;
        transform: translateY(-50%);
    }

    .float-contact a {
        display: grid;
        justify-items: center;
        gap: 4px;
        color: #ffffff;
        font-size: 9px;
        text-decoration: none;
    }

    .float-icon {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #ffffff;
        color: #f0b000;
        font-size: 13px;
        font-weight: 700;
    }

    @media (max-width: 575.98px) {
        .brand-mark,
        .brand-logo {
            width: 104px;
        }

        .float-contact {
            display: none;
        }
    }
</style>
