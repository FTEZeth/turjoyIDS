<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller{
    public function login(Request $request){

        $messages = makeMessages();

        // To validate the data
        $this->validate($request, [
            'email' => ['required'],
            'password' => ['required']
        ], $messages);

        // To check if the user exists
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('message', 'usuario no registrado o contraseña incorrecta');
        }

        return redirect()->route('menu');
    }
    //To check if the user is logged in and redirect to the menu
    public function logout(){

        auth()->logout();
        return redirect()->route('home');
    }
}
