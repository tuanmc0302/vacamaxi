<?php

namespace App\Presentation\Http\Controllers\Backend\Management;

use App\Models\User;
use App\Presentation\Http\Controllers\Backend\BackendController;
use Illuminate\Http\RedirectResponse;

class DestroyUserController extends BackendController
{
    public function __invoke(User $user): RedirectResponse
    {
        abort_if(auth()->id() === $user->id, 422, 'Bạn không thể tự xóa tài khoản đang đăng nhập.');

        $user->roles()->detach();
        $user->delete();

        return $this->redirectWithSuccess('admin.users.index', 'Đã xóa người dùng thành công.');
    }
}
