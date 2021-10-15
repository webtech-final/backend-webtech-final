<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointHistory;
use App\Models\User;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['login', 'register']
        ]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        $user->items()->attach([
            1 => ['equipped' => true],
            2 => ['equipped' => true],
        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $user = JWTAuth::user();
        $user->pointHistories;
        $user->playHistories;

        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function getPoint(Request $request, $id)
    {
        $point = $request->point;
        $user = User::findOrFail($id);
        $user->point = $user->point + $point;
        $user->save();
        return $user->point;
    }
    public function usePoint(Request $request, $id)
    {
        $point = $request->point;
        $user = User::findOrFail($id);
        $user->point = $user->point - $point;
        $user->save();
        return $user->point;
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
            'user' => auth()->user()
        ]);
    }

    public function uploadProfile(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'id' => 'required',
            'selectedImage' => 'required|mimes:jpg,jpeg,png'
        ]);

        if ($validator->fails()) {

            return response()->json(["status" => 'fail', "error" => $validator->errors()], 400);
        }

        $upload = new UploadController();
        $upload_res = $upload->uploadProfile($req);
        $user_id = $req->input('id');
        $user = User::findOrFail($user_id);
        $user->image = $upload_res->getData()->data;
        $user->save();

        return response()->json([
            'status' => 'success',
            'path' => $upload_res->getData()->data,
        ]);
    }

    public function updateName(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'new_name' => 'required|string|between:2,100'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user_id = $request->id;
        $new_name = $request->new_name;
        $user = User::findOrFail($user_id);
        $user->name = $new_name;
        $user->save();
        return $user->name;
    }
}
