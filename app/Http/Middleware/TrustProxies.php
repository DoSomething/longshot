<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application,
     * sourced from 'config/trustedproxy.php'.
     *
     * @var array
     */
    protected $proxies;

    /**
     * The current proxy header mappings.
     *
     * @var array
     */
    protected $headers = [
        Request::HEADER_FORWARDED => null, // Not set on AWS or Heroku.
        Request::HEADER_CLIENT_IP => 'X_FORWARDED_FOR',
        Request::HEADER_CLIENT_HOST => null, // Not set on AWS or Heroku.
        Request::HEADER_CLIENT_PROTO => 'X_FORWARDED_PROTO',
        Request::HEADER_CLIENT_PORT => 'X_FORWARDED_PORT',
    ];
}
