<?php

namespace App\Providers;

use Cache;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Scholarship\Repositories\SettingRepository;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'event.name' => [
            'EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $events->listen('settings.change', function($category) {
              if ($category === 'general') {

                // @TODO: get this to work
                // Cache::forget('setting.' . implode('.', SettingRepository::$pageQueryItems));
                // Cache::forget('setting.' . implode('.', SettingRepository::$nominateQueryItems));
                // foreach (SettingRepository::$individualQueryItems as $item) {
                //   Cache::forget('setting.' . $item);
                // }
                Cache::flush();

              } elseif ($category === 'meta_data') {

                // @TODO: get this to work
                // Cache::forget('setting.' . implode('.', SettingRepository::$openGraphDataQueryItems));

                // Cache::forget('setting.favicon');

                Cache::flush();


              } else {
                // @TODO: get this to work
                // Cache::forget('setting.' . $category);

                Cache::flush();
              }
        });
    }
}
