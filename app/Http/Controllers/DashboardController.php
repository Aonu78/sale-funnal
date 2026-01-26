<?php

namespace App\Http\Controllers;

use App\Models\Funnel;
use App\Models\FunnelSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $todayStart = now()->startOfDay();
        $weekStart  = now()->startOfWeek();   // Monday by default
        $monthStart = now()->startOfMonth();

        $funnelsTotal  = Funnel::count();
        $funnelsActive = Funnel::where('is_active', true)->count();

        $subsTotal = FunnelSubmission::count();
        $subsToday = FunnelSubmission::where('created_at', '>=', $todayStart)->count();
        $subsWeek  = FunnelSubmission::where('created_at', '>=', $weekStart)->count();
        $subsMonth = FunnelSubmission::where('created_at', '>=', $monthStart)->count();

        // Yes/No breakdown (overall)
        $yesCount = FunnelSubmission::whereRaw("lower(coalesce(question_answer,'')) = 'yes'")->count();
        $noCount  = FunnelSubmission::whereRaw("lower(coalesce(question_answer,'')) = 'no'")->count();

        // Top funnels by submissions (overall)
        $topFunnels = Funnel::query()
            ->withCount('submissions')
            ->orderByDesc('submissions_count')
            ->limit(8)
            ->get();

        // Recent submissions
        $recent = FunnelSubmission::with('funnel')
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'funnelsTotal','funnelsActive',
            'subsTotal','subsToday','subsWeek','subsMonth',
            'yesCount','noCount',
            'topFunnels','recent'
        ));
    }
}
