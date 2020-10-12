<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function addActivity(Request $request)
    {   
        $data = [
            'name' => $request->input('activity_name'),
            'created_at' => Carbon::now()->toDatetimeString(),
            'updated_at' => Carbon::now()->toDatetimeString(),
        ];
        Activity::create($data);
        return redirect('/');
    }
}
