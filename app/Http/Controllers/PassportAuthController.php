<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\UserStoreRequest;
use Illuminate\Http\Request;
use App\Models\User;

class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(UserStoreRequest $request)
    {
        $this->validate($request, [
            'surname' => 'nullable|string',
            'name' => 'required|string',
            'patronymic' => 'nullable|string',
            'email' => 'required|email',
            'age' => 'nullable|integer',
            'address' => 'nullable|string',
            'gender' => 'nullable|integer',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'surname' => $request->surname,
            'name' => $request->name,
            'patronymic' => $request->patronymic,
            'email' => $request->email,
            'age' => $request->age,
            'address' =>$request->address,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
        ]);


        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
