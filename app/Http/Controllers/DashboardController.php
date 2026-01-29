<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total visitors
        $totalVisitors = Visitor::count();
        
        // Today's visitors
        $todayVisitors = Visitor::whereDate('visited_at', today())->count();
        
        // This week visitors
        $weekVisitors = Visitor::whereBetween('visited_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        
        // This month visitors
        $monthVisitors = Visitor::whereMonth('visited_at', now()->month)
                                ->whereYear('visited_at', now()->year)
                                ->count();
        
        // Unique visitors (by IP)
        $uniqueVisitors = Visitor::distinct('ip_address')->count('ip_address');
        
        // Most visited pages
        $topPages = Visitor::select('page_visited', DB::raw('count(*) as visits'))
                          ->groupBy('page_visited')
                          ->orderByDesc('visits')
                          ->limit(5)
                          ->get();
        
        // Device breakdown
        $devices = Visitor::select('device', DB::raw('count(*) as count'))
                         ->groupBy('device')
                         ->get();
        
        // Browser breakdown
        $browsers = Visitor::select('browser', DB::raw('count(*) as count'))
                          ->groupBy('browser')
                          ->orderByDesc('count')
                          ->limit(5)
                          ->get();
        
        // Recent visitors
        $recentVisitors = Visitor::latest('visited_at')->limit(10)->get();
        
        // Visitors per day (last 7 days)
        $dailyVisitors = Visitor::select(DB::raw('DATE(visited_at) as date'), DB::raw('count(*) as count'))
                               ->where('visited_at', '>=', now()->subDays(7))
                               ->groupBy('date')
                               ->orderBy('date')
                               ->get();

        return view('admin.dashboard.index', compact(
            'totalVisitors',
            'todayVisitors', 
            'weekVisitors',
            'monthVisitors',
            'uniqueVisitors',
            'topPages',
            'devices',
            'browsers',
            'recentVisitors',
            'dailyVisitors'
        ));
    }
}
