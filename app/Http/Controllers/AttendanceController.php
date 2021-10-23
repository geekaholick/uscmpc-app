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
        $date_time_now = Carbon::now();
        $date_time_set = Carbon::create(2021, 10, 24, 9, 01, 00, "Asia/Manila");

        if(!$has_checked_in) {
            $attendance = new Attendance([
                'user_id' => $request->input('current_user'),
                'uscmpc_id' => $user->uscmpc_id,
                'time_in' => $date_time_now
            ]);
            $attendance->save();

            if($date_time_set->gte($date_time_now)) {
                $user->election_status = 2;
            } else {
                $user->election_status = 3;
            }
            
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

    public function getAttendanceUsers()
    {
        $data = [
            'total'=> Attendance::all()->count(),
            'regular' => Attendance::join('users', 'attendances.user_id', '=', 'users.id')->where('users.membership', '=', "Regular")->count(),
            'associate' => Attendance::join('users', 'attendances.user_id', '=', 'users.id')->where('users.membership', '=', "Associate")->count(),
        ];
        return $data;
    }
}
