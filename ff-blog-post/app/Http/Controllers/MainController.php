<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function view_home(Request $request)
    {

        $categories = Category::all()->each(function ($category) {
            $category->post_count = $category->posts()->count();
        });

        if($request->has('category')) {
            $posts = Post::where('category_id', $request->category)->paginate(4);


            return view('pages.home')->with([
                'posts' => $posts,
                'latestPosts' => Post::where('category_id', $request->category)->get()->take(-3),
                'popularPost' => $posts->sortByDesc('comment_count')->first(),
                'categories' => $categories
            ]);
        }

        $posts = Post::paginate(4);

        return view('pages.home')->with([
            'posts' => $posts,
            'latestPosts' => Post::all()->take(-3),
            'popularPost' => $posts->sortByDesc('comment_count')->first(),
            'categories' => $categories
        ]);
    }
    //
}
