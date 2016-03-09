<?php namespace App\Http\Middleware;

use Closure;
use Scholarship\Repositories\SettingRepository;
use App\Models\User;
use App\Models\Application;

use Auth;

class CheckIfAppSubmitted
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
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $application = User::with('application')->whereId($user->id)->first();
        if (!is_null($user->application)) {
          $complete = Application::isSubmitted($user->id);
          if (isset($complete)) {
            return Redirect::route('status')->with('flash_message', ['text' => 'You have already submitted your application, you can no longer edit.', 'class' => '-error']);
          }
        }
        
        return $next($request);
    }
}