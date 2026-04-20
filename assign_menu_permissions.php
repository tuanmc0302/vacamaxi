<?php

use App\Models\Permission;
use App\Models\Role;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

$permissions = [
    ['name' => 'admin.menu.view', 'title' => 'Xem Menu'],
    ['name' => 'admin.menu.edit', 'title' => 'Sửa Menu'],
    ['name' => 'admin.menu.delete', 'title' => 'Xóa Menu'],
];

$ids = [];
foreach ($permissions as $p) {
    $perm = Permission::firstOrCreate(['name' => $p['name']], ['title' => $p['title']]);
    $ids[] = $perm->id;
}

$role = Role::where('name', 'super_admin')->first();
if ($role) {
    $role->permissions()->syncWithoutDetaching($ids);
    echo "Thành công: Đã gán quyền quản lý menu cho Super Admin.\n";
} else {
    echo "Lỗi: Không tìm thấy vai trò super_admin.\n";
}
