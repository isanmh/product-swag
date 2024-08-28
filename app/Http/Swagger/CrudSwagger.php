<?php
// ======================== CRUD Swagger ========================
// ========Test API=========
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

//  ========Get All Products=========
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

// ========Get Product by id=========
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


// ========add Product=========
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

// ========update Product=========
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

// ========delete Product=========
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

// ========search Product=========
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
