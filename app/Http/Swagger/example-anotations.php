<?php

/**
 * @OA\Info(
 *    title="Your super  ApplicationAPI",
 *    version="1.0.0",
 * )
 */

################# REGISTER API #############################

/**
 * @OA\Post(
 * path="/api/register",
 * operationId="Register",
 * tags={"Register"},
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

################# LOGIN API #############################

/**
 * @OA\Post(
 *     path="/api/login",
 *     operationId="Login",
 *     tags={"Login"},
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

################## PROFILE API ############################

/**
 * @OA\Get(
 *     path="/api/profile",
 *     operationId="getProfile",
 *     tags={"Profile"},
 *     summary="Get user profile",
 *     description="Retrieve user profile information.",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="Authorization",
 *         in="header",
 *         description="Authorization Token",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             default="Bearer your_access_token_here"
 *         )
 *     ),
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
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
