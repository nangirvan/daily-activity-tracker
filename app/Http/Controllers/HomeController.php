<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Activity;
use App\Models\Progress;

class HomeController extends Controller
{
    public function index()
    {   
        $data = [
            'all_activities' => Activity::all(),
            'not_done_activities' => \DB::table('activities')
                                    ->leftjoin('progress', 'activities.id', '=', 'progress.activity_id')
                                    ->select('activities.id', 'activities.name', 'activities.created_at')
                                    ->where('progress.activity_id', NULL)
                                    ->get(),
            'progresses' => \DB::table('progress')
                            ->join('activities', 'activities.id', '=', 'progress.activity_id')
                            ->select('progress.id', 'progress.activity_id', 'activities.name', 'progress.start_at', 'progress.end_at', 'progress.target_minutes', 'progress.progress_minutes')
                            ->where('progress.date_added', '=', Carbon::now()->toDateString())
                            ->get(),
        ];
        return view('home', $data);
    }
}
