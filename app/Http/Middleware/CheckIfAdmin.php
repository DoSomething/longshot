<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Scholarship\Repositories\SettingRepository;

class CheckIfAdmin
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
        // Is current user an admin?
        if (! Auth::user() || ! Auth::user()->hasRole('administrator')) {
            return redirect()->home()->with('flash_message', ['text' => 'You are not authorized to view that page.', 'class' => '-error']);
        }

        return $next($request);
    }
}
