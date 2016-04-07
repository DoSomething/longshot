<?php namespace App\Http\Middleware;

use Closure;
use Scholarship\Repositories\SettingRepository;
use App\Models\User;
use App\Models\Application;
use Illuminate\Database\Eloquent\Model;


use Auth;

class CheckIfUserHasApp
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $value)
    {
        $user = Auth::user();
        if ($user && !is_null($user->$value)) {
          return redirect()->route($value.'.edit', $user->id);
        }

        return $next($request);
    }
}