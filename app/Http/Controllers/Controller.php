<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use App\Traits\ResponseFormatter;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseFormatter;

    /**
     * Render an Inertia view with shared/common props.
     */
    protected function inertiaRender(string $component, array $props = [])
    {
        $common = [
            'appName' => config('app.name'),
            'locale'  => app()->getLocale(),
        ];
        if (auth()->guard('web')->check()) {
            $common['authUser'] = auth()->guard('web')->user()->only(['id','name','email']);
        } elseif (auth()->guard('insider')->check()) {
            $common['authUser'] = auth()->guard('insider')->user()->only(['id','username','email']);
        } elseif (auth()->guard('vendor')->check()) {
            $common['authUser'] = auth()->guard('vendor')->user()->only(['id','company_name','email']);
        } elseif (auth()->guard('client')->check()) {
            $common['authUser'] = auth()->guard('client')->user()->only(['id','uIdentification','username','email']);
        }

        return Inertia::render($component, array_merge($common, $props));
    }
}
