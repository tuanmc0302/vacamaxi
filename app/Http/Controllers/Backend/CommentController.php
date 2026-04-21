<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::query()
            ->with('post')
            ->latest()
            ->paginate(20);

        return view('backend.management.comments.index', compact('comments'));
    }

    public function toggleApproval(Comment $comment)
    {
        $comment->update(['is_approved' => !$comment->is_approved]);
        $status = $comment->is_approved ? 'đã duyệt' : 'đã ẩn';
        return back()->with('status', "Bình luận {$status}.");
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('status', 'Đã xóa bình luận.');
    }
}
