<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max' => [
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
    ],
    'unique' => 'El :attribute ya ha sido registrado.',
    'regex' => 'El formato del campo :attribute no es válido.',
    'custom' => [
        'contra_cliente' => [
            'regex' => 'La contraseña debe tener al menos una letra mayúscula, un número y uno de los siguientes caracteres especiales: ! @ # $.',
        ],
    ],

    'attributes' => [
        'nombre_cliente' => 'nombre',
        'apellido_cliente' => 'apellido',
        'correo_cliente' => 'correo',
        'contra_cliente' => 'contraseña',
        'tele_cliente' => 'teléfono',
    ],
];
