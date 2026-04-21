<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Models\User;
use App\Presentation\Http\Controllers\Backend\BackendController;
use App\Presentation\Http\Requests\Backend\Management\StoreUserRequest;
use Illuminate\Http\RedirectResponse;

class UpdateUserController extends BackendController
{
    public function __invoke(StoreUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $attributes = [
            'full_name' => $validated['full_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
        ];

        if (filled($validated['password'] ?? null)) {
            $attributes['password'] = $validated['password'];
        }

        $user->update($attributes);

        return $this->redirectWithSuccess('admin.users.index', 'Đã cập nhật người dùng thành công.');
    }
}
