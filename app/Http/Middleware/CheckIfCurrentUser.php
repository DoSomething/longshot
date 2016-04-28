<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use Scholarship\Repositories\SettingRepository;

class CheckIfCurrentUser
{
    /**
     * @var SettingsRepository
     */
    protected $settings;

    public function __construct(SettingRepository $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect()->home();
        }
          // // @TODO: protect both the applicaiton/profile edit routes!
          // if (Auth::user()->id !== (int)$route->parameter('profile')) {
          //   return Redirect::home();
          // }

        return $next($request);
    }
}
