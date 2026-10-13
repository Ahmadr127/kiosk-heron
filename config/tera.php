<?php

return [
    /*
    |--------------------------------------------------------------------------
    | TERA Mobile Webservice (RS Azra)
    |--------------------------------------------------------------------------
    | Kredensial kiosk untuk login ke webservice TERA, lalu memanggil
    | endpoint seperti listappointment. Token login di-cache agar tidak
    | login ulang di setiap permintaan (lihat App\Services\TeraService).
    |
    | TERA_BIRTHDATE_FORMAT: format tanggal lahir yang dikirim ke API,
    | mis. Y-m-d (2026-01-31) atau d-m-Y (31-01-2026). Tampilan di layar
    | kiosk selalu DD-MM-YYYY; yang berubah hanya format kirimannya.
    */
    'base_url' => (string) env('TERA_BASE_URL', 'https://v3-api-webservice.teramobile.app/api/v1'),
    'username' => (string) env('TERA_USERNAME', ''),
    'password' => (string) env('TERA_PASSWORD', ''),
    'timeout' => (int) env('TERA_TIMEOUT', 15),
    'token_ttl' => (int) env('TERA_TOKEN_TTL', 3300),
    'birthdate_format' => (string) env('TERA_BIRTHDATE_FORMAT', 'Y-m-d'),
];
