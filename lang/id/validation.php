<?php

return [

    'required' => ':attribute wajib diisi.',
    'string' => ':attribute harus berupa teks.',
    'numeric' => ':attribute harus berupa angka.',
    'integer' => ':attribute harus berupa angka bulat.',
    'digits' => ':attribute harus terdiri dari :digits digit.',
    'digits_between' => ':attribute harus antara :min dan :max digit.',
    'min' => [
        'numeric' => ':attribute minimal :min.',
        'string' => ':attribute minimal :min karakter.',
    ],
    'max' => [
        'numeric' => ':attribute maksimal :max.',
        'string' => ':attribute maksimal :max karakter.',
    ],
    'unique' => ':attribute ini sudah terdaftar.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'date' => ':attribute bukan tanggal yang valid.',
    'in' => ':attribute yang dipilih tidak valid.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'url' => ':attribute harus berupa URL yang valid.',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    'attributes' => [],

];