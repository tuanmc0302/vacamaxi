<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Models\User;
use App\Presentation\Http\Controllers\Backend\BackendController;
use App\Presentation\Http\Requests\Backend\Management\StoreUserRequest;
use Illuminate\Http\RedirectResponse;

class StoreUserController extends BackendController
{
    public function __invoke(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::query()->create([
            'full_name' => $validated['full_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return $this->redirectWithSuccess('admin.users.index', 'Đã tạo người dùng mới thành công.');
    }
}
