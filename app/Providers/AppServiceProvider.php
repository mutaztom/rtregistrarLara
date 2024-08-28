<?php

namespace App\Providers;

use App\Models\Tblregistrant;
use App\Reports\OrderPrintReport;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
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

        Gate::define('order.print', function (Tblregistrant $user, OrderPrintReport $report) {
            if (Auth::check()) {
                return Response::allow();
            }
            if (Auth::guard('admin')->check()) {
                return Response::allow();
            }

            return Response::deny('You are not authorized to view this report.');
        });
        Gate::define('order.edit', function (User $user, RequestOrder $order) {
            return $user->id === $order->user_id;
        });
    }
}
