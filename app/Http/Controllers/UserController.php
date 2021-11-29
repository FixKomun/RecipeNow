<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Database;

class UserController extends Controller
{
    /*
    //FIREBASE INTEGREATiON
    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    */
    public function index()
    {
        return view('welcome');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30',
            'email' => 'bail|required|email|unique:users|max:30',
            'password' => 'bail|required|min:6'
        ]);

        $password = bcrypt($request->password);
        User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => $password,
        ]);

        /*Firebase
        $user = [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => $password,
        ];

        $user = $this->database->getReference('users')->push($user);
        */
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            return response()->json([
                'msg' => 'You are logged in',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'msg' => 'Unknown user'

            ], 401);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
