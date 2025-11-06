<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines (Bahasa Indonesia)
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut berisi pesan default yang digunakan oleh
    | kelas validator. Beberapa aturan ini memiliki beberapa versi
    | seperti aturan ukuran. Silakan sesuaikan pesan-pesan ini.
    |
    */

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

    // Anda bisa menambahkan terjemahan lain di sini jika diperlukan...

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut
    | menggunakan konvensi "attribute.rule" untuk menamai baris.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar placeholder atribut
    | dengan sesuatu yang lebih mudah dibaca seperti "Alamat E-Mail"
    | daripada "email". Ini membantu kita membuat pesan lebih ekspresif.
    |
    | ANDA TIDAK PERLU MENGISI INI. Gunakan method attributes()
    | di dalam Form Request Anda (seperti StoreDataAnakRequest)
    | untuk hasil yang lebih baik dan terorganisir.
    |
    */

    'attributes' => [],

];