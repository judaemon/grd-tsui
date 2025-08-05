<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TallStackUi\Facades\TallStackUi;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        TallStackUi::personalize('layout')
           ->block('main', "mx-auto max-w-full p-2 w-full h-full")
           ->and()
           ->layout()
           ->block("wrapper.first", "min-h-screen")
           ->block("wrapper.second.expanded", "md:pl-72 flex flex-col h-screen")
           ;
    }
}
