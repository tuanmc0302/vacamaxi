<?php

namespace App\Presentation\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Post;
use App\Models\Contact;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $currentUser = auth()->user();

        return view('backend.dashboard.index', [
            'overviewCards' => [
                [
                    'label' => 'Sản phẩm',
                    'value' => number_format(Product::query()->count()),
                    'description' => 'Tổng số sản phẩm trong hệ thống',
                ],
                [
                    'label' => 'Bài viết',
                    'value' => number_format(Post::query()->count()),
                    'description' => 'Tổng số bài viết tin tức',
                ],
                [
                    'label' => 'Liên hệ mới',
                    'value' => number_format(Contact::query()->where('is_read', false)->count()),
                    'description' => 'Yêu cầu liên hệ chưa xử lý',
                ],
                [
                    'label' => 'Tổng người dùng',
                    'value' => number_format(User::query()->count()),
                    'description' => 'Số tài khoản quản trị hệ thống',
                ],
            ],
            'systemHighlights' => [
                'Kiến trúc hiện tại đi theo luồng Request -> Controller -> UseCase -> Interface -> Repository.',
                'Menu bên trái đọc từ file cấu hình, tập trung vào trải nghiệm người dùng.',
                'Hệ thống quản lý Sản phẩm, Tin tức, Liên hệ và Bình luận đã được tích hợp.',
            ],
            'currentUser' => $currentUser,
        ]);
    }
}
