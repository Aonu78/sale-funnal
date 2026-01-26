<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funnel;
use App\Models\FunnelSubmission;
use Illuminate\Http\Request;

class FunnelSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $funnels = Funnel::orderBy('title')->get();

        $q = FunnelSubmission::query()->with('funnel');

        if ($request->filled('funnel_id')) {
            $q->where('funnel_id', $request->funnel_id);
        }

        if ($request->filled('answer')) {
            $q->where('question_answer', $request->answer);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $q->where(function($w) use ($s) {
                $w->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            });
        }

        if ($request->filled('from')) {
            $q->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $q->whereDate('created_at', '<=', $request->to);
        }

        $submissions = $q->latest()->paginate(25)->withQueryString();

        return view('admin.submissions.index', compact('submissions','funnels'));
    }
}
