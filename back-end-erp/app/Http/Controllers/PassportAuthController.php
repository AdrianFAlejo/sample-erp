<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Resources\UserAuthResource;
// use App\Traits\ValidateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('ERP')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        try {
            DB::beginTransaction();

            $credentials = $request->only('email', 'password');

            $email = $request->email;

            $user = User::orWhere('email', $email)->first();

            if (!$user) {
                return response()->json('User does not exist!', 401);
            }

            if (auth()->attempt($credentials)) {
                $tokenResult = auth()->user()->createToken('ERP');
                $token = $tokenResult->token;
                $token->save();

                $response = [
                    "token" => $tokenResult->accessToken,
                    "user" => new UserAuthResource($user),
                ];

                DB::commit();

                return response()->json($response);

            } else {
                return response()->json('Email or Password is incorrect!', 201);
            }

        } catch (Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage(), $request->all());
        }

    }

    public function userInfo()
    {

        $user = auth()->user();

        return response()->json(['user' => $user], 200);

    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->token()->revoke();
        return response()->json(['message' => 'Successfully logged out', $user->email]);
    }
}
