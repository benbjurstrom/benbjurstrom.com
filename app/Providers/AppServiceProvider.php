<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        seo()
            ->site('Ben Bjurstrom')
            ->title(
                default: 'Ben Bjurstrom',
                modify: fn (string $title) => $title . ' | Ben Bjurstrom'
            )
            ->withUrl()
            ->description(default: 'Personal website belonging to Ben Bjurstrom')
            ->image(default: fn () => asset('ogimage.png'))
            ->twitterSite('@benbjurstrom');


        $appUrl = trim(config('app.url'), '/');
        if(request()->getSchemeAndHttpHost() !== $appUrl) {
            seo()->robots('noindex');
        }
    }
}
