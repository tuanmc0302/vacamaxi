<?php

namespace App\Presentation\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $currentUser = auth()->user();

        return view('backend.dashboard.index', [
            'overviewCards' => [
                [
                    'label' => 'Tổng người dùng',
                    'value' => number_format(User::query()->count()),
                    'description' => 'Tất cả tài khoản backend trong hệ thống',
                ],
                [
                    'label' => 'Vai trò',
                    'value' => number_format(Role::query()->count()),
                    'description' => 'Nhóm quyền đang được cấu hình',
                ],
                [
                    'label' => 'Quyền truy cập',
                    'value' => number_format(Permission::query()->count()),
                    'description' => 'Tổng permission đang hoạt động',
                ],
                [
                    'label' => '2FA đã bật',
                    'value' => number_format(User::query()->where('google_two_factor_enabled', true)->count()),
                    'description' => 'Tài khoản đã kích hoạt Google 2FA',
                ],
            ],
            'systemHighlights' => [
                'Kiến trúc hiện tại đi theo luồng Request -> Controller -> UseCase -> Interface -> Repository.',
                'Menu bên trái đọc từ file cấu hình và tự ẩn theo quyền của tài khoản hiện tại.',
                'CRUD người dùng, vai trò, tìm kiếm, lọc và xác nhận xóa đã được dựng sẵn.',
            ],
            'currentUser' => $currentUser?->loadMissing('roles'),
        ]);
    }
}
