<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Nature;
use App\Models\Tag;
use Illuminate\Contracts\Cache\Store;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $categorys = Category::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $data = Blog::where('is_deleted', 'no')
            ->with(['tags.tag', 'categories.category', 'author', 'nature'])
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.blog.blog', compact('data', 'tags', 'categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title',
            'status' => 'required',
            'nature' => 'required|numeric',
            'author' => 'required|numeric',
            'image' => 'nullable',
            'detail' => 'nullable'
        ]);

        // Create a new blog entry
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->status = $request->status;
        $blog->nature_id = $request->nature;
        $blog->author_id = $request->author;
        $blog->image = $request->hasFile('image') ? $request->file('image')->store('images/blog', 'public') : '';
        $blog->detail = $request->detail;

        if ($blog->save()) {
            // Insert tags in bulk to blog_tags table
            if ($request->has('tag') && is_array($request->tag)) {
                $tags = array_map(function ($tagId) use ($blog) {
                    return [
                        'blog_id' => $blog->id,
                        'tag_id' => $tagId,
                    ];
                }, $request->tag);

                DB::table('blog_tags')->insert($tags);
            }

            // Insert categories in bulk to blog_categories table
            if ($request->has('category') && is_array($request->category)) {
                $categories = array_map(function ($categoryId) use ($blog) {
                    return [
                        'blog_id' => $blog->id,
                        'category_id' => $categoryId,
                    ];
                }, $request->category);

                DB::table('blog_categorys')->insert($categories);
            }

            // Redirect back with success message
            return redirect()->route('blog.index')->with('success', 'Blog Created!');
        } else {
            return view('admin.blog.add');
        }
    }

    public function check(Request $request)
    {
        $data = blog::where('is_deleted', 'no')->where('title', $request->name)->first();

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Title already exists'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => ''
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $nature = Nature::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $author = Author::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $tags = Tag::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $categorys = Category::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        return view('admin.blog.add', compact('author', 'nature', 'tags', 'categorys'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nature = Nature::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $author = Author::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $tags = Tag::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $categorys = Category::where('is_deleted', 'no')->orderBy('id', 'desc')->get();
        $data = Blog::with(['tags.tag', 'categories.category', 'author', 'nature'])->find($id);

        return view('admin.blog.update', compact('data', 'nature', 'author', 'tags', 'categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title,' . $id,
            'status' => 'required',
            'nature' => 'required|numeric',
            'author' => 'required|numeric',
            'image' => 'nullable|image',
            'detail' => 'nullable'
        ]);

        $data = [
            'title' => $request->title,
            'status' => $request->status,
            'nature_id' => $request->nature,
            'author_id' => $request->author,
            'image' => $request->hasFile('image')
                ? $request->file('image')->store('images/blog', 'public')
                : Blog::find($id)->image,
            'detail' => $request->detail
        ];

        if (Blog::find($id)->update($data)) {
            // Update tags
            if ($request->has('tag') && is_array($request->tag)) {
                DB::table('blog_tags')->where('blog_id', $id)->delete();
                $tags = array_map(function ($tagId) use ($id) {
                    return [
                        'blog_id' => $id,
                        'tag_id' => $tagId,
                    ];
                }, $request->tag);
                DB::table('blog_tags')->insert($tags);
            }

            // Update categories
            if ($request->has('category') && is_array($request->category)) {
                DB::table('blog_categorys')->where('blog_id', $id)->delete();
                $categories = array_map(function ($categoryId) use ($id) {
                    return [
                        'blog_id' => $id,
                        'category_id' => $categoryId,
                    ];
                }, $request->category);
                DB::table('blog_categorys')->insert($categories);
            }

            return redirect()->route('blog.index')->with('success', 'Blog Updated!');
        } else {
            return redirect()->back()->with('error', 'Failed to update the blog!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $blog->update(['is_deleted' => 'yes']);
            return redirect()->route('blog.index')->with('success', 'Blog Deleted!');
        } else {
            return redirect()->route('blog.index')->with('error', 'Blog not found!');
        }
    }
    // public function update_status($id)
    // {
    //     $blog = Blog::find($id);
    //     if ($blog->status == 'active') {
    //         $blog->update(['status'=>'inactive']);
    //     } else if ($blog->status == 'inactive') {
    //         $blog->update(['status'=>'active']);
    //     }
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Status Updated !'
    //     ]);
    // }
}
