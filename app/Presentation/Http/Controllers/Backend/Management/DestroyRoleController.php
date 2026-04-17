<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Models\Role;
use App\Presentation\Http\Controllers\Backend\BackendController;
use Illuminate\Http\RedirectResponse;

class DestroyRoleController extends BackendController
{
    public function __invoke(Role $role): RedirectResponse
    {
        abort_if($role->name === 'super_admin', 422, 'Không thể xóa vai trò hệ thống super_admin.');

        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();

        return $this->redirectWithSuccess('admin.roles.index', 'Đã xóa vai trò thành công.');
    }
}
