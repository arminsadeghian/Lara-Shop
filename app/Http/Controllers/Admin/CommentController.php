<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'کامنت مورد نظر حذف شد');
    }

    public function changeApprove(Comment $comment)
    {
        if ($comment->approved == 1) {
            $comment->update([
                'approved' => 0
            ]);

            return back()->with('failed', 'کامنت مورد نظر غیر فعال شد و دیگر در سایت نمایش داده نمیشود.');
        } else {
            $comment->update([
                'approved' => 1
            ]);

            return back()->with('success', 'کامنت مورد نظر فعال شد و در سایت نمایش داده میشود.');
        }
    }
}
