<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // 驗證請求的資料
        $request->validated();

        // 生成驗證碼
        $verificationCode = Str::random(40);

        // 創建新用戶
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'verification_code' => $verificationCode,
        ]);

        // 發送驗證郵件
        Mail::to($user->email)->send(new VerificationMail($user));

        return jason(['success' => '註冊成功，請檢查您的郵箱以完成驗證']);
    }


    public function login(LoginRequest $request)
    {
        $request->validated();

        // 實現登入邏輯，生成 JWT
        $credentials = $request->only('email', 'password');

        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json(compact('token'));
        }

        return response()->json(['error' => 'Unauthorized'], 401);

    }

    public function logout(Request $request)
    {
        try {
            // 驗證請求中是否包含有效的令牌
            $token = JWTAuth::parseToken()->authenticate();

            // 如果令牌驗證通過，加進黑名單，使其失效
            if ($token) {
                JWTAuth::parseToken()->invalidate();
                return response()->json(['success' => 'Successfully logged out']);
            } else {
                // 如果令牌無效，返回錯誤訊息
                return response()->json(['error' => 'Forbidden'], 403);
            }
        } catch (\Exception $e) {
            // 處理可能的異常，例如令牌無效等
            return response()->json(['error' => 'Forbidden'], 403);
        }
    }

}