<?php

namespace App\Http\Middleware;

use App\Models\Scholarship;
use Auth;
use Closure;
use Scholarship\Repositories\SettingRepository;

class RedirectIfScholarshipClosed
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
        // Is the scholarship closed?
        if (Scholarship::isClosed()) {
            // Check if the user is a guest, or if not an admin, redirect.
            if ((Auth::user() && !(Auth::user()->hasRole('administrator'))) || Auth::guest()) {
                return redirect()->home()->with('flash_message', ['text' => 'Applications have closed for the year!', 'class' => '-error']);
            }
        }

        return $next($request);
    }
}

        // /*
        //  * This filter checks to see if the scholarhsip is closed
        //  * If so, it blocks many many routes.
        //  */
        // Route::middleware('isClosed', function ($route, $request) {
        //   // Is the scholarship closed?
        //   if (Scholarship::isClosed()) {
        //       // Check if the user is a guest, or if not an admin, redirect.
        //     if ((Auth::user() && !(Auth::user()->hasRole('administrator'))) || Auth::guest()) {
        //         return Redirect::home()->with('flash_message', ['text' => 'Applications have closed for the year!', 'class' => '-error']);
        //     }
        //   }
        // });
