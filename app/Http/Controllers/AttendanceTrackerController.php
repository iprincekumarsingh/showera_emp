<?php

namespace App\Http\Controllers;

use App\Models\at_tracker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceTrackerController extends Controller
{
    protected function in_time(Request $request)
    {
        $today = Carbon::today()->toDateString();


        $at_tracker = at_tracker::where('employee_id', $request['employee_id'])
            ->whereDate('created_at', $today)
            ->latest()->first();
        $at_tracker = new at_tracker;
        $at_tracker->in_time = $request['in_time'];
        $at_tracker->employee_id = $request['employee_id'];
        $at_tracker->save();

        return response()->json([
            'success' => '1',
            'data' => $at_tracker
        ]);

    }
    protected function out_time(Request $request)
    {

        $today = Carbon::today()->toDateString();
        $at_tracker = at_tracker::where('employee_id', $request['employee_id'])
            ->whereDate('created_at', $today)
            ->latest()->first();
        $at_tracker->out_time = $request['out_time'];
        // update
        $at_tracker->save();

        return response()->json([
            'success' => '1',
            'data' => $at_tracker
        ]);
    }
    protected function get_in_status(Request $request)
    {
        $today = Carbon::today()->toDateString();
        $at_tracker = at_tracker::where('employee_id', $request['employee_id'])
            ->whereDate('created_at', $today)
            ->latest()->first();
        // check a row is empty or not
        if ($at_tracker->in_time != null) {
            return response()->json([
                'success' => '1',
                'data' => $at_tracker
            ]);
        } else {
            return response()->json([
                'success' => '0',
                'data' => $at_tracker
            ]);
        }


    }
    protected function get_out_status(Request $request)
    {
        $today = Carbon::today()->toDateString();
        $at_tracker = at_tracker::where('employee_id', $request['employee_id'])
            ->whereDate('created_at', $today)
            ->latest()->first();
        // check a row is empty or not
        if ($at_tracker->out_time != null) {
            return response()->json([
                'success' => '1',
                'data' => $at_tracker
            ]);
        } else {
            return response()->json([
                'success' => '0',
                'data' => $at_tracker
            ]);
        }


    }
}