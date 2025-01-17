<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"products"},
     *     summary="Get list of products",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Product::query();

        if ($status) {
            $query->where('status', $status);
        }

        $products = $query->get();
        return response()->json($products);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"products"},
     *     summary="Create a new product",
     *     description="Create a new product with the provided data",
     *     operationId="store",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "subtitle", "launch_date", "company_name", "content"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="subtitle", type="string"),
     *             @OA\Property(property="launch_date", type="string", format="date"),
     *             @OA\Property(property="company_name", type="string"),
     *             @OA\Property(property="video", type="string", format="uri"),
     *             @OA\Property(property="content", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input data"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'launch_date' => 'required|date',
            'company_name' => 'required|string',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:768000', // Video max size 750MB
            'content' => 'required|string',
        ]);

        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"products"},
     *     summary="Get a product by ID",
     *     description="Fetch a single product by its ID",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     tags={"products"},
     *     summary="Update an existing product",
     *     description="Update a product with the provided data",
     *     operationId="update",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "subtitle", "launch_date", "company_name", "content"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="subtitle", type="string"),
     *             @OA\Property(property="launch_date", type="string", format="date"),
     *             @OA\Property(property="company_name", type="string"),
     *             @OA\Property(property="video", type="string", format="uri"),
     *             @OA\Property(property="content", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json($product);
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"products"},
     *     summary="Delete a product",
     *     description="Delete a product by its ID",
     *     operationId="destroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Product deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
}
