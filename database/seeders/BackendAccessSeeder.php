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
            ->whereIn('name', ['admin.dashboard.view'])
            ->pluck('id')
            ->all();

        $seoRole->permissions()->sync($seoPermissions);

        $user = User::query()->where('username', 'sondev03')->first();

        if ($user) {
            $user->roles()->syncWithoutDetaching([$superAdmin->id]);
        }
    }
}
