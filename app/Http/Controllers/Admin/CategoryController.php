<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = auth()->user()->id;

        $slug = Str::slug($validatedData['name']);

        // Cek apakah slug sudah digunakan, jika iya, tambahkan nomor acak
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = Str::slug($validatedData['name']) . '-' . $count;
            $count++;
        }

        $validatedData['slug'] = $slug;

        $category = Category::create($validatedData);

        return response()->json([
            'message' => 'Berhasil Ditambahkan',
            'data' => new CategoryResource($category->loadMissing('user')),
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('user')->find($id);

        if (!$category) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "category not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::with('user')->find($id);

        if (!$category) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "Category not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        // Validasi data dari request
        $validatedData = $request->validated();

        // Buat slug dari judul
        $slug = Str::slug($validatedData['name']);

        // Cek apakah slug sudah digunakan oleh category lain, jika iya, tambahkan nomor acak
        $count = 1;
        while (category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = Str::slug($validatedData['name']) . '-' . $count;
            $count++;
        }

        $validatedData['slug'] = $slug;

        // Update data category
        $category->update($validatedData);

        return response()->json([
            'message' => 'Berhasil Diubah',
            'data' => new CategoryResource($category->loadMissing('user'))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::with('user')->find($id);

        if (!$category) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "Category not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $category->delete();
        // return response()->json(['message' => 'Berhasil Dihapus']);
        // return new categoryResource($category->loadMissing('category:id,name', 'user:id,name'));
        return response()->json([
            'message' => 'Berhasil Dihapus',
            'data' => new CategoryResource($category)
        ]);
    }
}
