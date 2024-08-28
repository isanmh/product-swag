<?php

namespace App\Http\Middleware;

use App\Http\Controllers\API\AuthController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ah = AuthController::header;
        $res1 = $request->header('X-PARTNER-ID');
        $res2 = $request->header('X-EXTERNAL-ID');
        $res3 = $request->header('X-SIGNATURE');
        $res4 = $request->header('X-TIMESTAMP');

        if (
            $res1 === $ah['X-PARTNER-ID'] &&
            $res2 === $ah['X-EXTERNAL-ID'] &&
            $res3 === $ah['X-SIGNATURE'] &&
            $res4 === $ah['X-TIMESTAMP']
        ) {
            return $next($request);
        } else {
            return response()->json(
                [
                    'status' => 503,
                    'error' => "Silahkan isi header dengan benar"
                ]
            );
        }
    }
}
