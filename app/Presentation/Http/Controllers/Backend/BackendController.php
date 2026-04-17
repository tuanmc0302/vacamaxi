<?php

namespace App\Presentation\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

abstract class BackendController extends Controller
{
    protected function redirectWithSuccess(string $route, string $message): RedirectResponse
    {
        return redirect()
            ->route($route)
            ->with('status', $message);
    }
}
