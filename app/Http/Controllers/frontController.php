<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Nature;
use App\Models\Reply;
use App\Models\Tag;
use App\Models\View;
use Illuminate\Support\Facades\DB;

class frontController extends Controller
{

    public function index()
    {
        $data = Blog::where('is_deleted', 'no')
            ->with(['author'])
            ->orderBy('id', 'desc')
            ->limit(12)
            ->get(); // Don't forget to add get() to execute the query and retrieve the results

        $popular = View::select('blog_id', DB::raw('COUNT(*) as view_count'))
            ->groupBy('blog_id')
            ->orderByDesc('view_count')
            ->limit(6)
            ->get();

        $blogIds = $popular->pluck('blog_id'); // Extract blog IDs

        $popular_blogs = Blog::whereIn('id', $blogIds)->get();
        return view('index', compact('data', 'popular_blogs'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contactus');
    }

    public function blist()
    {
        $tags = Tag::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $categorys = Category::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $data = Blog::where('is_deleted', 'no')
            ->with(['tags.tag', 'categories.category', 'author', 'nature'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        $data5 = Blog::where('is_deleted', 'no')
            ->with(['tags.tag', 'categories.category', 'author', 'nature'])
            ->orderBy('id', 'desc')->limit(5)
            ->get();

        $popular = View::select('blog_id', DB::raw('COUNT(*) as view_count'))
            ->groupBy('blog_id')
            ->orderByDesc('view_count')
            ->limit(6)
            ->get();

        $blogIds = $popular->pluck('blog_id'); // Extract blog IDs

        $popular_blogs = Blog::whereIn('id', $blogIds)->get();
        return view('blog', compact('data', 'data5', 'tags', 'categorys', 'popular_blogs'));
    }

    public function bdetail(string $title)
    {
        //prepare to add in view first
        $data = Blog::where('title', $title)->firstOrFail();
        $view = new View();
        $view->blog_id = $data->id;
        $view->save();

        $tags = Tag::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $categorys = Category::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $data = Blog::where('title', $title)->with(['tags.tag', 'categories.category', 'author', 'nature', 'comment'])->firstOrFail();
        $post = Blog::where('is_deleted', 'no')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
        $related = Blog::where('is_deleted', 'no')
            ->where('nature_id', $data->nature_id)
            ->where('nature_id', '!=', 0)
            ->where('id', '!=', $data->id) // Exclude current blog
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();

        $popular = View::select('blog_id', DB::raw('COUNT(*) as view_count'))
            ->groupBy('blog_id')
            ->orderByDesc('view_count')
            ->limit(5)
            ->get();

        $blogIds = $popular->pluck('blog_id'); // Extract blog IDs

        $popular_blogs = Blog::whereIn('id', $blogIds)->get();

        return view('single-blog', compact('data', 'tags', 'categorys', 'post', 'related', 'popular_blogs'));
    }

    public function commentSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50', // Only alphabetic characters allowed, max 20 chars
            'email' => 'required|email',
            'user' => 'required|integer',
            'message' => 'required|string'
        ]);

        $comment = new Comment();
        $comment->blog_id = $request->user;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->detail = $request->message;
        $comment->save();

        return redirect()->back()->with('success', 'Comment Added SuccessFully');
    }

    public function commentComment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|alpha|max:20', // Only alphabetic characters allowed, max 20 chars
            'email' => 'required|email',
            'user' => 'required|integer',
            'comment' => 'required|integer',
            'message' => 'required|string'
        ]);

        $comment = new Reply();
        $comment->comment_id = $request->comment;
        $comment->blog_id = $request->user;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->detail = $request->message;
        $comment->save();

        return redirect()->back()->with('success', 'Comment Added SuccessFully');
    }

    public function searchBlog(Request $request)
    {
        // Retrieve the search keyword from the query string
        $search = $request->input('search');

        // Fetch tags and categories that are not deleted
        $tags = Tag::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $categorys = Category::where('is_deleted', 'no')->orderBy('id', 'desc')->get();

        // Query blogs with pagination
        $data = Blog::where('is_deleted', 'no')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->with(['tags.tag', 'categories.category', 'author', 'nature'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Fetch top 5 blogs matching the search query (optional)
        $data5 = Blog::where('is_deleted', 'no')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->with(['tags.tag', 'categories.category', 'author', 'nature'])
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $popular = View::select('blog_id', DB::raw('COUNT(*) as view_count'))
            ->groupBy('blog_id')
            ->orderByDesc('view_count')
            ->limit(6)
            ->get();

        $blogIds = $popular->pluck('blog_id'); // Extract blog IDs

        $popular_blogs = Blog::whereIn('id', $blogIds)->get();

        // Return the view with data
        return view('blog', compact('data', 'data5', 'tags', 'categorys', 'search', 'popular_blogs'));
    }
}
