<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $validateData = $request->validated();

        $validateData['user_id'] = auth()->user()->id;
        $validateData['excerpt'] = Str::limit(strip_tags($request->content), 100);

        // Buat slug dari judul
        $slug = Str::slug($validateData['title']);

        // Cek apakah slug sudah digunakan, jika iya, tambahkan nomor acak
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = Str::slug($validateData['title']) . '-' . $count;
            $count++;
        }

        $validateData['slug'] = $slug;

        Post::create($validateData);

        return response()->json(['message' => 'Berhasil Ditambahkan']);
    }

    /** 
     * Display the specified resource.
     */
    public function show(Post $post): PostResource
    {
        $post = Post::with(['category:id,name', 'user:id,name'])->findOrFail($post->id);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(PostRequest $request, Post $post)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $post->delete();
        return response()->json(['message' => 'Berhasil Dihapus']);
    }
}
