<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Activity;
use App\Models\Progress;

class ProgressController extends Controller
{
    public function addProgress(Request $request)
    {   
        $target_minutes = ($request->input('progress_hour')*60)+$request->input('progress_minutes');
        $data = [
            'activity_id' => Activity::where('name', $request->input('progress_activity'))->get('id')[0]['id'],
            'target_minutes' => $target_minutes,
            'start_at' => Carbon::now()->toDatetimeString(),
            'date_added' => Carbon::now()->toDateString()
        ];
        Progress::create($data);
        return redirect('/');
    }

    public function updateProgress(Request $request)
    {   
        $progress = Progress::where('id', $request->input('id'))->get();
        $start_time = Carbon::create($progress[0]['start_at']);
        $end_time = Carbon::now()->toDatetimeString();

        $data = [
            'end_at' => $end_time,
            'progress_minutes' => $start_time->diffInMinutes($end_time),
        ];

        Progress::where('id', $request->input('id'))->update($data);
        return redirect('/');
    }
}
