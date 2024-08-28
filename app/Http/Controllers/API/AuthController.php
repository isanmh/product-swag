<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // custom header
    public const header = [
        'X-PARTNER-ID' => '82150823919040624621823174737537',
        'X-EXTERNAL-ID' => '41807553358950093184162180797837',
        'X-SIGNATURE' => '85be817c55b2c135157c7e89f52499bf0c25ad6eeebe04a986e8c862561b19a5',
        'X-TIMESTAMP' => '2020-12-18T15:06:00+07:00'
    ];

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
    // Registrasi
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        // create user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            // 'password' => Hash::make($fields['password']), // ini pake library Hash
        ]);
        // buat token untuk user
        $token = $user->createToken('TokenRahasiaInix')->plainTextToken;
        $res = [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
            'code' => Response::HTTP_CREATED
        ];
        return response()->json($res, Response::HTTP_CREATED);
    }

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
    // Login
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        // cek email
        $user = User::where('email', $fields['email'])->first();
        // cek email dan password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
                'code' => Response::HTTP_UNAUTHORIZED // 401
            ], Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken('TokenRahasiaInix')->plainTextToken;
        $res = [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
            'code' => Response::HTTP_OK
        ];
        return response()->json($res, Response::HTTP_OK);
    }

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
    public function user()
    {
        $data = [
            'user' => auth()->user(),
            'code' => Response::HTTP_OK
        ];
        return response()->json(
            $data,
            Response::HTTP_OK
        );
    }


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
    // logout
    public function logout()
    {
        // revoke login token
        auth()->user()->tokens->each(function ($token) {
            $token->delete();
        });
        $data = [
            'message' => "logout berhasil",
            'code' => Response::HTTP_OK
        ];
        return response()->json(
            $data,
            Response::HTTP_OK
        );
    }
}
