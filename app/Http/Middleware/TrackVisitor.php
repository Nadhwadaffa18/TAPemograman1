<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        // Skip tracking for admin pages and setup routes
        if ($request->is('admin/*') || $request->is('setup-database') || 
            $request->is('create-admin') || $request->is('check-*') || 
            $request->is('test-*')) {
            return $next($request);
        }

        try {
            // Detect device type
            $userAgent = $request->userAgent() ?? 'Unknown';
            $device = 'Desktop';
            if (preg_match('/Mobile|Android|iPhone|iPad/i', $userAgent)) {
                $device = preg_match('/iPad|Tablet/i', $userAgent) ? 'Tablet' : 'Mobile';
            }

            // Detect browser
            $browser = 'Other';
            if (preg_match('/Chrome/i', $userAgent)) $browser = 'Chrome';
            elseif (preg_match('/Firefox/i', $userAgent)) $browser = 'Firefox';
            elseif (preg_match('/Safari/i', $userAgent)) $browser = 'Safari';
            elseif (preg_match('/Edge/i', $userAgent)) $browser = 'Edge';
            elseif (preg_match('/Opera|OPR/i', $userAgent)) $browser = 'Opera';

            Visitor::create([
                'ip_address' => $request->ip(),
                'user_agent' => substr($userAgent, 0, 500),
                'page_visited' => $request->path(),
                'referrer' => $request->header('referer') ? substr($request->header('referer'), 0, 500) : null,
                'device' => $device,
                'browser' => $browser,
                'visited_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Silent fail - don't break the site if tracking fails
        }

        return $next($request);
    }
}
