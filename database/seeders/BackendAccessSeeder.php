<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class BackendAccessSeeder extends Seeder
{
    public function run(): void
    {
        $permissionMap = [
            'admin.dashboard.view' => 'Xem bảng điều khiển',
            'admin.widgets.view' => 'Xem cấu hình widget trang chủ',
            'admin.widgets.edit' => 'Cập nhật cấu hình widget trang chủ',
            'admin.categories.view' => 'Xem danh mục sản phẩm và bài viết',
            'admin.categories.create' => 'Tạo danh mục sản phẩm và bài viết',
            'admin.categories.edit' => 'Cập nhật danh mục sản phẩm và bài viết',
            'admin.categories.delete' => 'Xóa danh mục sản phẩm và bài viết',
            'admin.products.view' => 'Xem sản phẩm',
            'admin.products.create' => 'Tạo sản phẩm',
            'admin.products.edit' => 'Cập nhật sản phẩm',
            'admin.products.delete' => 'Xóa sản phẩm',
            'admin.posts.view' => 'Xem bài viết',
            'admin.posts.create' => 'Tạo bài viết',
            'admin.posts.edit' => 'Cập nhật bài viết',
            'admin.posts.delete' => 'Xóa bài viết',
            'admin.users.view' => 'Xem danh sách người dùng',
            'admin.users.create' => 'Tạo mới người dùng',
            'admin.users.edit' => 'Cập nhật người dùng',
            'admin.users.delete' => 'Xóa người dùng',
            'admin.roles.view' => 'Xem vai trò và quyền',
            'admin.roles.create' => 'Tạo mới vai trò và gán quyền',
            'admin.roles.delete' => 'Xóa vai trò',
            'admin.security.manage' => 'Quản lý Google 2FA',
        ];

        $permissions = collect($permissionMap)->map(function (string $title, string $name) {
            return Permission::query()->updateOrCreate(
                ['name' => $name],
                ['title' => $title],
            );
        });

        $superAdmin = Role::query()->updateOrCreate(
            ['name' => 'super_admin'],
            ['title' => 'Quản trị hệ thống'],
        );

        $seoRole = Role::query()->updateOrCreate(
            ['name' => 'seo'],
            ['title' => 'SEO'],
        );

        $superAdmin->permissions()->sync($permissions->pluck('id')->all());

        $seoPermissions = $permissions
            ->whereIn('name', [
                'admin.dashboard.view',
                'admin.widgets.view',
                'admin.widgets.edit',
                'admin.categories.view',
                'admin.posts.view',
                'admin.posts.create',
                'admin.posts.edit',
            ])
            ->pluck('id')
            ->all();

        $seoRole->permissions()->sync($seoPermissions);

        User::query()
            ->whereIn('username', ['sondev03', 'testuser', 'admin'])
            ->get()
            ->each(fn (User $user) => $user->roles()->syncWithoutDetaching([$superAdmin->id]));
    }
}
