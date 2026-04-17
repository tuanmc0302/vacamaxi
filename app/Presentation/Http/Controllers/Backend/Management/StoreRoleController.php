<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Models\Role;
use App\Presentation\Http\Controllers\Backend\BackendController;
use App\Presentation\Http\Requests\Backend\Role\StoreRoleRequest;
use Illuminate\Http\RedirectResponse;

class StoreRoleController extends BackendController
{
    public function __invoke(StoreRoleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $role = Role::query()->create([
            'name' => $validated['name'],
            'title' => $validated['title'],
        ]);

        $role->permissions()->sync($validated['permission_ids'] ?? []);

        return $this->redirectWithSuccess('admin.roles.index', 'Đã tạo vai trò mới thành công.');
    }
}
