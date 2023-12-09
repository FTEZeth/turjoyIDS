<?php

function makeMessages()
{

    $messages = [

        'email.required' => 'debe ingresar su correo electrónico para iniciar sesión',
        'email.email' => 'usuario no registrado o contraseña incorrecta',
        'password.required' => 'debe ingresar su contraseña para iniciar sesion',
        'document.format' => 'el formato del archivo es incorrecto',
        'document.required' => 'el campo archivo es requerido',
        'document.mimes' => 'el archivo seleccionado no es Excel con extensión xlsx',
        'document.min' => 'el archivo excel esta vacio',
        'document.max' => 'el tamaño máximo del archivo a cargar no puede superar los 5 megabytes',
        'initDate.required' => 'el campo fecha de inicio es requerido',
        'initDate.date' => 'el campo fecha de inicio debe ser una fecha válida',
        'finishDate.required' => 'el campo fecha de término es requerido',
        'finishDate.date' => 'el campo fecha de término debe ser una fecha válida',
        'finishDate' => 'la fecha de inicio a consultar no puede ser mayor que la fecha de término de la consulta',
        /*
        'seat.required' => 'debe ingresar la cantidad de asientos',
        'total.required' => 'debe ingresar el total a pagar',
        'date.required' => 'debe ingresar la fecha de la reserva',
        'route_id.required' => 'debe ingresar la ruta de la reserva',
        'payment_method.required' => 'debe ingresar el método de pago'
        */
    ];

    return $messages;
}

function randomString($length)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
