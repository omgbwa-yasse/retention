<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getVisitorStats()
    {
        try {
            $stats = DB::table('visitor_stats')
                ->select(
                    'country_name',
                    'country_code',
                    DB::raw('DATE(visited_at) as date'),
                    DB::raw('COUNT(*) as count')
                )
                ->where('country_name', '!=', 'Unknown')
                ->groupBy('country_name', 'country_code', 'date')
                ->orderBy('date', 'desc')
                ->get();

            return response()->json($stats);
        } catch (\Exception $e) {
            return response()->json([]);
        }
    }
}
