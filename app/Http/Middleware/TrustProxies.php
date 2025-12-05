<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Proxy yang dipercaya agar header X-Forwarded-* dipakai Laravel.
     *
     * Gunakan nilai dari env APP_TRUSTED_PROXIES jika tersedia,
     * default ke '*' (semua proxy) supaya reverse proxy seperti Caddy/Nginx dikenali.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * Buat instance dan isi proxy dari konfigurasi.
     */
    public function __construct()
    {
        $this->proxies = config('app.trusted_proxies', env('APP_TRUSTED_PROXIES', '*'));
    }

    /**
     * Header yang harus dipercaya.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
