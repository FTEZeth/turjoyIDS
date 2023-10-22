<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller{
    public function login(Request $request){

        $messages = makeMessages();

        // Validar los campos ingresados
        $this->validate($request, [
            'email' => ['required'],
            'password' => ['required']
        ], $messages);

        // Intentar autenticar al usuario
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('message', 'usuario no registrado o contraseña incorrecta');
        }

        return redirect()->route('upload');
    }

    public function logout(){

        auth()->logout();
        return redirect()->route('home');
    }
}
