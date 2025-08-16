<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $user = auth()->user();
        $query = Post::with('user')
            ->withCount('claps')
            ->where('published_at', '<=', now())
            ->latest();

            

        if ($user) {
            $ids = $user->following()->pluck('users.id')->toArray();
            $query->whereIn('user_id', $ids);
        }

        $posts = $query->orderBy('created_at', 'DESC')->paginate(5);

        $context = [
            'posts' => $posts
        ];
        return view('post.index', $context);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::get();
        $context = [
            "categories" => $categories
        ];
        return view('post.create', $context);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {   //
        // $toBeValidated = [
        //     'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4096'],
        //     'title' => 'required',
        //     'content' => 'required',
        //     'category_id' => ['required', 'exists:categories,id'],
        //     'published_at' => ['nullable', 'datetime']
        // ];

        // $data = $request->validate($toBeValidated);
        
        $data = $request->validated();
        $data ['slug'] = Str::slug($data['title']);
        $data ['user_id'] = auth()->id();

        // to save the image
        $image = $data['image'];
        $imagePath = $image->store('posts', 'public');
        $data['image'] = $imagePath;
        
        
        Post::create($data);
        
        return redirect()->route('dashboard');
    }
 

    /**
     * Display the specified resource.
     */
    public function show(String $username, Post $post)
    {
        //
        $context = [
            'post' => $post
        ];
        return view('post.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        if ($post->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to delete this post.');
            //return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this post.');
        }
        $context = [
            'post' => $post,
            'categories' => Category::all()
        ];
        return view('post.edit', $context);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        //
        if ($post->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to update this post.');
            //return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this post.');
        }

        $data = $request->validated();

        // if the image has been updated
        if ($request->hasFile('image')) {
            $image = $data['image'];
            $imagePath = $image->store('posts', 'public');
            $data['image'] = $imagePath;
        }
        
        $post->update($data);

        return redirect()->route('my_posts')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        if ($post->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to delete this post.');
            //return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this post.');
        }
        $post->delete();
        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }

    public function category(Category $category)
    {        
        // $user = auth()->user();
        // $query = Post::with('user')
        //     ->withCount('claps')
        //     ->where('published_at', '<=', now())
        //     ->latest();

        // if ($user) {
        //     $ids = $user->following()->pluck('users.id')->toArray();
        //     $query->whereIn('user_id', $ids);
        // }

        // $posts = $query->orderBy('created_at', 'DESC')->paginate(5);

        $posts = $category->posts()
            ->with('user')
            ->withCount('claps')
            ->where('published_at', '<=', now())
            ->orderBy('created_at', 'DESC')->paginate(5);

        $context = [
            'posts' => $posts,
            'category' => $category
        ];
        return view('post.index', $context);
    }

    public function myPosts()
    {
        $user = auth()->user();
        $posts = $user->posts()
            ->with('user')
            ->withCount('claps')
            ->orderBy('created_at', 'DESC')->paginate(5);

        $context = [
            'posts' => $posts
        ];
        return view('post.index', $context);
    }
}
