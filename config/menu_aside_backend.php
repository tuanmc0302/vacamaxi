<?php

return [
    [
        'title' => 'Tổng quan',
        'route' => 'admin.dashboard',
        'icon' => 'home',
        'permission' => 'admin.dashboard.view',
    ],
    [
        'title' => 'Widget trang chủ',
        'route' => 'admin.widgets.index',
        'icon' => 'grid',
        'permission' => 'admin.widgets.view',
    ],
    [
        'title' => 'Quản lý Menu',
        'route' => 'admin.menu.index',
        'icon' => 'grid',
        'permission' => 'admin.menu.view',
    ],
    [
        'title' => 'Danh mục sản phẩm',
        'route' => 'admin.product-categories.index',
        'icon' => 'box',
        'permission' => 'admin.categories.view',
    ],
    [
        'title' => 'Danh mục bài viết',
        'route' => 'admin.news-categories.index',
        'icon' => 'file',
        'permission' => 'admin.categories.view',
    ],
    [
        'title' => 'Sản phẩm',
        'route' => 'admin.products.index',
        'icon' => 'box',
        'permission' => 'admin.products.view',
    ],
    [
        'title' => 'Bài viết',
        'route' => 'admin.posts.index',
        'icon' => 'file',
        'permission' => 'admin.posts.view',
    ],
    [
        'title' => 'Danh sách người dùng',
        'route' => 'admin.users.index',
        'icon' => 'users',
        'permission' => 'admin.users.view',
    ],
    [
        'title' => 'Thêm mới người dùng',
        'route' => 'admin.users.create',
        'icon' => 'users',
        'permission' => 'admin.users.create',
    ],
    [
        'title' => 'Danh sách vai trò',
        'route' => 'admin.roles.index',
        'icon' => 'shield',
        'permission' => 'admin.roles.view',
    ],
    [
        'title' => 'Thêm mới vai trò',
        'route' => 'admin.roles.create',
        'icon' => 'shield',
        'permission' => 'admin.roles.create',
    ],
    [
        'title' => 'Google 2FA',
        'route' => 'admin.two-factor.settings',
        'icon' => 'shield',
        'permission' => 'admin.security.manage',
    ],
];