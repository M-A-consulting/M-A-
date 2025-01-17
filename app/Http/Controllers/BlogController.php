<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/blogs",
     *     tags={"blogs"},
     *     summary="Get list of blogs",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Blog::all());
    }

    /**
     * @OA\Post(
     *     path="/api/blogs",
     *     tags={"blogs"},
     *     summary="Create a blog",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="content", type="string"),
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="image", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created successfully"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id'],
            'content' => 'required',
            'image' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $blog = Blog::create($request->only(['title', 'user_id', 'content', 'image']));

        return response()->json(['message' => 'Blog created successfully', 'blog' => $blog], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/blogs/{id}",
     *     tags={"blogs"},
     *     summary="Get a specific blog",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the blog",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(response=404, description="Blog not found")
     * )
     */
    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        return response()->json($blog);
    }

    /**
     * @OA\Put(
     *     path="/api/blogs/{id}",
     *     tags={"blogs"},
     *     summary="Update a specific blog",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the blog",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="content", type="string"),
     *             @OA\Property(property="image", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Blog updated successfully",
     *     ),
     *     @OA\Response(response=404, description="Blog not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => ['sometimes', 'string', 'max:255'],
            'user_id' => ['sometimes', 'exists:users,id'],
            'content' => 'sometimes',
            'image' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $blog->update($request->only(['title', 'user_id', 'content', 'image']));

        return response()->json(['message' => 'Blog updated successfully', 'blog' => $blog]);
    }

    /**
     * @OA\Delete(
     *     path="/api/blogs/{id}",
     *     tags={"blogs"},
     *     summary="Delete a specific blog",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the blog",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Blog deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Blog not found")
     * )
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully']);
    }
}
