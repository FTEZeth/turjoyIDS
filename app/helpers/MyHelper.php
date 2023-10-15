<?php

function makeMessages()
{

    $messages = [

        'email.required' => 'debe ingresar su correo electrónico para iniciar sesión',
        'email.email' => 'usuario no registrado o contraseña incorrecta',
        'password.required' => 'debe ingresar su contraseña para iniciar sesion',
        'document.required' => 'el campo archivo es requerido',
        'document.mimes' => 'el archivo seleccionado no es Excel con extensión xlsx',
        'document.min' => 'el archivo excel esta vacio',
        'document.max' => 'el tamaño máximo del archivo a cargar no puede superar los 5 megabytes'


    ];

    return $messages;

}
