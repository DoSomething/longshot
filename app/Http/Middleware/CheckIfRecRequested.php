<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Models\User;
use App\Models\Application;
use App\Models\Recommendation;
use Scholarship\Repositories\SettingRepository;

class CheckIfRecRequested
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
        $user = Auth::user();
        if ($user) {
            $application = Application::where('user_id', $user->id)->first();
            $recommendations = Recommendation::where('application_id', $application->id)->get()->toArray();

            if (! empty($recommendations)) {
                return redirect()->route('recommendation.edit', ['user' => $user->id, 'app_id' => $application->id]);
            }
        }

        return $next($request);
    }
}
