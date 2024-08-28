<?php
// ======simpan di controller base======
/**
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="api_key",
 *     name="Authorization"
 * )
 */

//  ======Register======
/**
 * @OA\Post(
 * path="/api/register",
 * operationId="Register",
 * tags={"Users"},
 * summary="User Register",
 * description="User Register here",
 *     @OA\RequestBody(
 *         @OA\JsonContent(),
 *         @OA\MediaType(
 *            mediaType="multipart/form-data",
 *            @OA\Schema(
 *               type="object",
 *               required={"name","email", "password", "password_confirmation"},
 *               @OA\Property(property="name", type="text"),
 *               @OA\Property(property="email", type="text"),
 *               @OA\Property(property="password", type="password"),
 *               @OA\Property(property="password_confirmation", type="password")
 *            ),
 *        ),
 *    ),
 *      @OA\Response(
 *          response=201,
 *          description="Register Successfully",
 *          @OA\JsonContent()
 *       ),
 *      @OA\Response(
 *          response=200,
 *          description="Register Successfully",
 *          @OA\JsonContent()
 *       ),
 *      @OA\Response(
 *          response=422,
 *          description="Unprocessable Entity",
 *          @OA\JsonContent()
 *       ),
 *      @OA\Response(response=400, description="Bad request"),
 *      @OA\Response(response=404, description="Resource Not Found"),
 * )
 */

//  ======Login======
/**
 * @OA\Post(
 *     path="/api/login",
 *     operationId="Login",
 *     tags={"Users"},
 *     summary="User Login",
 *     description="User Login here",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *            mediaType="multipart/form-data",
 *            @OA\Schema(
 *               type="object",
 *               required={"email", "password"},
 *               @OA\Property(property="email", type="string", example="isan@gmail.com"),
 *               @OA\Property(property="password", type="string", example="123456"),
 *            ),
 *        ),
 *        @OA\MediaType(
 *            mediaType="application/json",
 *            @OA\Schema(
 *               type="object",
 *               required={"email", "password"},
 *               @OA\Property(property="email", type="string", example="isan@gmail.com"),
 *               @OA\Property(property="password", type="string", example="123456"),
 *            ),
 *        ),
 *    ),
 *    @OA\Response(
 *        response=201,
 *        description="Login Successfully",
 *        @OA\JsonContent()
 *    ),
 *    @OA\Response(
 *        response=200,
 *        description="Login Successfully",
 *        @OA\JsonContent()
 *    ),
 *    @OA\Response(
 *        response=422,
 *        description="Unprocessable Entity",
 *        @OA\JsonContent()
 *    ),
 *    @OA\Response(response=400, description="Bad request"),
 *    @OA\Response(response=404, description="Resource Not Found"),
 * )
 */

//  ======user detail======
/**
 * @OA\Get(
 *     path="/api/user",
 *     operationId="User",
 *     tags={"Users"},
 *     summary="User detail",
 *     description="Use Bearer Token",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent()
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */

//  ======logout======
/**
 * @OA\Post(
 *     path="/api/logout",
 *     operationId="Logout",
 *     tags={"Users"},
 *     summary="User Logout",
 *     description="User Logout here",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Logout Successfully",
 *         @OA\JsonContent()
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     )
 * )
 */
