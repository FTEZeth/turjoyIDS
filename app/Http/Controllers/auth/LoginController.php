<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

    class LoginController extends Controller {
        public function store(Request $request) {
            $messages = makeMessages();
            //validar datos
            $this->validate($request, [
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:8']
            ], $messages);

            //Si el usuario se autentica true, si se autentica false
            if(!auth()->attempt($request->only('email','password'), $request-remember)){
                return back()->with('message', 'rdencialss estan malas');
            }

            return redirect()->route('upload');
        }
    }
}
