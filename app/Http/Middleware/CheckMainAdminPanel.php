<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckMainAdminPanel
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        /** @var \Domain\Access\Admin\Models\Admin|null $admin */
        $admin = Filament::auth()->user();

      

        if (null == $admin  OR null == $admin->admin_id) {
           
            if (Route::currentRouteName() === "filament.admin.auth.login") {
                return $next($request);
            }
            if ($admin->hasRole('super_admin')) {
                return $next($request);
            }
            abort(404, trans('You are not allowed to access this page.'));
        }

        return $next($request);
    }
}
