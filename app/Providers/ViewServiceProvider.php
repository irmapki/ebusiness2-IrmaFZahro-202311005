<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share unread notifications count with admin layout
        View::composer('layouts.admin', function ($view) {
            if (auth()->check()) {
                $unreadCount = Notification::where('user_id', auth()->id())
                    ->unread()
                    ->count();
                
                $view->with('unreadCount', $unreadCount);
            }
        });
    }
}