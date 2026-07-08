<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot(): void
{
    View::composer('*', function ($view) {

        if (Auth::check()) {

            $notifications = Notification::where('user_id', Auth::id())
                ->latest()
                ->take(5)
                ->get();

            $notificationCount = Notification::where('user_id', Auth::id())
                ->where('is_read', false)
                ->count();

            $view->with([
                'notifications' => $notifications,
                'notificationCount' => $notificationCount,
            ]);
        }

    });
}
}
