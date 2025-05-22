<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!is_null($yourToken = request()->bearerToken())) {
            $yourToken = request()->bearerToken();
            $token = \Laravel\Sanctum\PersonalAccessToken::findToken($yourToken);
            $user_id = $token->tokenable;
            $user_author = User::findOrFail($user_id->id);
            if (Hash::check("admin", $user_author->password)) {
                return response()->json([
                    'message' => $user_author->password
                ], 403);
            }
        } else {
            return response()->json([
                'message' => "Forbidden for you"
            ], 403);
        }
    }
}
