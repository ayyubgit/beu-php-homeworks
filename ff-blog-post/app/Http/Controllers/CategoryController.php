<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view("admin.category", compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:6',
        ]);

        Category::create([
            'title' => $request->title,
        ]);

        return redirect('/admin/categories');
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

    public function delete(Request $request, Category $category)
    {
        $category->delete();

        return redirect()->back();
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
        return view('admin.category-create')->with([
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|string|min:6',
        ]);

        $category->update([
            'title' => $request->title,
        ]);

        return redirect('admin/categories');
    }

    public function view_edit_admin(Category $category)
    {
        return view('admin.category-edit', compact('category'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(["id" => $category->id]);
    }
    //
}
