<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:6',
            'body' => 'required|string',
            'thumbnail' => 'required|file|mimes:png,jpg,jpeg',
            'category' => 'required|exists:categories,id',
            'slug' => 'required|unique:posts,slug'
        ]);

        $file = $request->file('thumbnail');

        $path = Storage::putFile('public/images', $file, 'public');

        $path = str_replace('public/', '', $path);
        $path = "uploads/{$path}";

        if ($request->slug == '')
            $request->slug = Str::slug($request->title);


        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'body' => $request->body,
            'thumbnail' => $path,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
        ]);

        return redirect('post/' . $request->slug);
    }

    public function createAdmin(Request $request)
    {
        $categories = Category::all();

        return view('admin.post-create', compact('categories'));
    }

    public function show(Request $request, string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $categories = Category::all()->each(function ($category) {
            $category->post_count = $category->posts()->count();
        });

        return view('pages.post.show')->with([
            'post' => $post,
            'latestPosts' => Post::all()->take(-3),
            'categories' => $categories
        ]);
    }

    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment' => $request->comment
        ]);

        return redirect()->back();
    }

    public function reply_comment(Request $request, Post $post, PostComment $comment)
    {
        $request->validate([
            'reply' => 'required|string'
        ]);

        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment' => $request->reply,
            'comment_id' => $comment->id
        ]);

        return redirect()->back();
    }

    public function delete(Request $request, Post $post)
    {
        $post->delete();

        return response('/');
    }

    public function view_edit(Request $request, Post $post)
    {
        $categories = Category::all();
        return view('admin.post.update')->with([
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function view_create(Request $request)
    {
        $categories = Category::all();
        return view('admin.post.create')->with([
            'categories' => $categories
        ]);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('admin.post-edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|min:6',
            'body' => 'required|string',
            'slug' => 'required|string',
            'thumbnail' => 'nullable|file|mimes:png,jpg,jpeg',
            'category' => 'required|exists:categories,id'
        ]);


        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => Str::slug($request->slug),
            'category_id' => $request->category,
        ]);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');

            $path = Storage::putFile('public/images', $file, 'public');

            $path = str_replace('public/', '', $path);
            $path = "uploads/{$path}";

            $post->update(['thumbnail' => $path]);
        }

        return redirect('admin/post/' . $post->slug);
    }

    public function indexAdmin()
    {
        $posts = Post::all()->map(function ($post) {
            $post->categories = $post->category->title;
            return $post;
        });


        return view("admin.post", compact('posts'));
    }

    //
}
