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
        '/feed/*', // Makes sure when you have an old csrf session, the website still works. Might fix in the future but because it's behind a login, I don't see it has high priority
    ];
}
