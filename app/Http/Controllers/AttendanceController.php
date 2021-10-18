<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
    public function check_in(Request $request)
    {
        $user = User::find($request->input('current_user'));
        $has_checked_in = Attendance::where('user_id', $request->input('current_user'))->first();
        if(!$has_checked_in) {
            $attendance = new Attendance([
                'user_id' => $request->input('current_user'),
                'uscmpc_id' => $user->uscmpc_id,
                'time_in' => Carbon::now()
            ]);
            $attendance->save();

            $user->election_status = 2;
            $user->save();

            return "Check-in successfully.";
        } else {
            return "Has already check-in";
        }
    }

    public function time_in(Request $request)
    {
        $has_checked_in = Attendance::where('user_id', $request->input('current_user'))->first();
        if($has_checked_in) {
            return $has_checked_in->time_in;
        } else {
            return "Has already check-in";
        }
    }
}
