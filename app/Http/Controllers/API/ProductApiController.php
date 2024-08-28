<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/test",
     *      operationId="test",
     *      tags={"Product"},
     *      summary="Test API",
     *      description="Test API",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Test API"),
     *              @OA\Property(property="code", type="integer", example=200),
     *          )
     *       ),
     * )
     */

    // test api
    public function test()
    {
        return response()->json(
            [
                'message' => 'Test API',
                'code' =>  200
            ],
            200
        );
    }

    /**
     * @OA\Get(
     *      path="/api/products",
     *      operationId="index",
     *      tags={"Product"},
     *      summary="Get all products",
     *      description="Get all products",
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="integer", example=200),
     *              @OA\Property(property="message", type="string", example="Get All products"),
     *              @OA\Property(property="data", type="array",
     *              @OA\Items(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="name", type="string", example="Product 1"),
     *              @OA\Property(property="price", type="integer", example=10000),
     *              @OA\Property(property="description", type="string", example="Description product 1"),
     *              @OA\Property(property="image", type="string", example="image.jpg"),
     *              )
     *            )
     *        )
     *     ),
     * )
     */
    // Get all products
    public function index()
    {
        // $products = Product::all();
        $products = Product::orderBy('id', 'desc')->paginate(5);
        $data = [
            'status' => 200,
            'message' => 'Get All products',
            'data' => $products
        ];

        return response()->json($products, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *      path="/api/products/{id}",
     *      operationId="show",
     *      tags={"Product"},
     *      summary="Get product by id",
     *      description="Get product by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200,description="Success",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    // Get product by id
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            $data = [
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data produk tidak ditemukan',
                'data' => $product
            ];
            return response()->json($data, Response::HTTP_NOT_FOUND);
        } else {
            $data = [
                'code' => Response::HTTP_OK,
                'message' => 'Berhasil menampilkan detail data',
                'data' => $product
            ];
            return response()->json($data, Response::HTTP_OK);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/products",
     *      operationId="store",
     *      tags={"Product"},
     *      summary="Create new product",
     *      description="Create new product",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                type="object",
     *                required={"name", "price", "description", "image"},
     *                @OA\Property(property="name", type="string", example="Product 1"),
     *                @OA\Property(property="price", type="integer", example="10000"),
     *                @OA\Property(property="description", type="string", example="Description product 1"),
     *                @OA\Property(property="image", type="string", format="binary"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    // Create new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
            'image' => 'image|mimes:png,jpg,webp,jpeg,svg|max:2048',
        ]);
        $input = $request->all();
        if ($image = $request->file('image')) {
            $target = 'assets/images/';
            $product_img = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($target, $product_img);
            $input['image'] = "$product_img";
        }

        Product::create($input);

        $data = [
            'code' => Response::HTTP_CREATED,
            'message' => 'Berhasil menambahkan data',
            'data' => $input
        ];
        return response()->json($data, Response::HTTP_CREATED);
    }


    /**
     * @OA\Put(
     *      path="/api/products/{id}",
     *      operationId="update",
     *      tags={"Product"},
     *      summary="Update product by id",
     *      description="Update product by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                type="object",
     *                required={"name", "price", "description", "image"},
     *                @OA\Property(property="name", type="string", example="Product 1"),
     *                @OA\Property(property="price", type="integer", example="10000"),
     *                @OA\Property(property="description", type="string", example="Description product 1"),
     *                @OA\Property(property="image", type="string", example="image.jpg"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    // Update product by id
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $request->validate([
                'name' => 'string|max:255',
                'price' => 'integer',
                'description' => 'string',
                // 'image' => 'image|mimes:png,jpg,webp,jpeg,svg|max:2048',
            ]);
            $input = $request->all();

            if ($image = $request->file('image')) {
                $target = 'assets/images/';
                // gambar lama dihapus
                if ($product->image) {
                    unlink($target . $product->image);
                }
                $product_img = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($target, $product_img);
                $input['image'] = "$product_img";
            }
            $product->update($input); // masukan update data ke database
            $data = [
                'code' => Response::HTTP_OK,
                'message' => 'Berhasil mengubah data',
                'data' => $product
            ];
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data = [
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'Product tidak ditemukan',
                'data' => null
            ];
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/products/{id}",
     *      operationId="destroy",
     *      tags={"Product"},
     *      summary="Delete product by id",
     *      description="Delete product by id",
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Product deleted successfully",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    // Delete product by id
    public function destroy($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            $data = [
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data produk tidak ditemukan',
            ];
            return response()->json($data, Response::HTTP_NOT_FOUND);
        } else {
            $product->delete();
            $data = [
                'code' => Response::HTTP_OK,
                'message' => 'Berhasil menghapus data',
            ];
            return response()->json($data, Response::HTTP_OK);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/search",
     *      operationId="search",
     *      tags={"Product"},
     *      summary="Search product by name",
     *      description="Search product by name",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                type="object",
     *                required={"name"},
     *                @OA\Property(property="name", type="string", example="Coffee"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    // Search product by parameter name
    public function search(Request $request)
    {
        $name = $request->name;

        $products = Product::where('name', 'like', '%' . $name . '%')->paginate();
        if (count($products) > 0) {
            return response()->json($products, Response::HTTP_OK);
        } else {
            $data = [
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Data tidak ditemukan',
                'data' => null
            ];
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
}
