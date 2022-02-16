<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirstVisit
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->userFeeds()->count() === 0) {
            return redirect(route('introduction.index'));
        }

        return $next($request);
    }
}
