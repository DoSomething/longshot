<?php

namespace App\Http\Middleware;

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
            return redirect()->route('login')->with('flash_message', ['text' => 'You must be logged in to do that.', 'class' => '-warning']);
        }

        return $next($request);
    }
}
