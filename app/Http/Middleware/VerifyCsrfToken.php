<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/tablero/souvenirs/image/',
        '/tablero/souvenirs/update/image',
        '/tablero/activities/image',
        '/tablero/activities/update/image'
    ];
}
