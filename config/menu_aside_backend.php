<?php

return [
    [
        'title' => 'Tổng quan',
        'route' => 'admin.dashboard',
        'icon' => 'home',
        'permission' => 'admin.dashboard.view',
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
    ],
];
