<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password2' => 'required|same:password',
            'photo_user' => 'mimes:jpeg,jpg,png|max:10000',
            'cover_user' => 'mimes:jpeg,jpg,png|max:10000'
        ]);

        if ($validate->fails()) {
            return response()->json(["error" => $validate->errors()], 401);
        }

        $name = $request->name;
        $email = $request->email;
        $api_token = sha1(time());
        $password = bcrypt($request->password);
        $role = $request->role;
        $photo_user = $request->photo_user;
        $cover_user = $request->cover_user;
        $path_photo_user = "";
        $path_cover_user = "";

        if ($photo_user == null) {
            $path_photo_user = "";
        } else {
            $path_photo_user =
                "Photo-user" . date('dmyhis') . $photo_user->getClientOriginalName();
            $photo_user->move('image/user/photo', $path_photo_user);
        }

        if ($cover_user == null) {
            $path_cover_user = "";
        } else {
            $path_cover_user =
                "Photo-user" . date('dmyhis') . $cover_user->getClientOriginalName();
            $cover_user->move('image/user/cover', $path_cover_user);
        }

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->api_token = $api_token;
        $user->role = $role;
        $user->photo_user = "image/user/photo/" . $path_photo_user;
        $user->cover_user = "image/user/cover/" . $path_cover_user;
        $user->save();
        $success['api_token'] = $user->api_token;

        if($user){
            return response()->json($success,201);
        }else{
            return response()->json(["error" => "error register"],400);
        }
    }
    public function login(Request $request)
    {
        $credential = $request->only('email','password');
        if(Auth::attempt($credential)){
            $user = Auth::user();
            $success['api_token'] = $user->api_token;
            $success['uid'] = $user->id;
            return response()->json($success,200);
        }else{
            return response()->json(['error' => "error login"],401);
        }
    }
    public function users()
    {
        $user = Auth::User();
        return response()->json($user,200);
    }
    public function alluser()
    {
        $user = User::all();
        return response()->json($user,200);
    }
}
