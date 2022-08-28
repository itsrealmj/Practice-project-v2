<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\user;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUsers() 
    {
        return user::all();
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users,email'
        ]);

        $data['password'] = Hash::make($request->password);

        $createdUser = User::create($data);
        
        return response()->json([
            'user_token' => $createdUser->createToken('login_token')->plainTextToken,
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */

    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }

    public function verifyUser(Request $request)
    {   
        $validate = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $validate['email'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'This email is not register',
            ]);
        } elseif (!Hash::check($validate['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => 'Wrong credentials',
            ]);
        }
        return response()->json([
            'user_token' => $user->createToken('login_token')->plainTextToken,
        ]);


    }
}
