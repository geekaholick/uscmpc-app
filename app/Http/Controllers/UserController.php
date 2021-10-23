<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function validateCanVote(Request $request, $id)
    {
        $user = User::find($id);
        $member = Member::where('first_name', '=', $user->first_name)
            ->where('last_name', '=', $user->last_name)->get();

        if($member != ''){
            $user->uscmpc_id = $member[0]->uscmpc_id;
            $user->membership = ($member[0]->membership==1)? "Regular": "Associate";
            $user->can_vote = $member[0]->vote_status;
            $user->membership_date = $member[0]->membership_date;
            $user->save();

            return "Successfully validated.";
        }else{
            return "Member not found!!";
        }
//        return Member::all();
    }

    public function validateCannotVote(Request $request, $id)
    {
        $user = User::find($id);
        $member = Member::where('first_name', '=', $user->first_name)
            ->where('last_name', '=', $user->last_name)->get();

        if($member != ''){
            $user->uscmpc_id = $member[0]->uscmpc_id;
            $user->membership = ($member[0]->membership==1)? "Regular": "Associate";
            $user->can_vote = 0;
            $user->membership_date = $member[0]->membership_date;
            $user->save();

            return "Successfully validated.";
        }else{
            return "Member not found!!";
        }

        return $member[0]->first_name;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCountStatistics()
    {
        $data = [
            'voters'=> User::where('can_vote', '=', 1)->count(),
            'voted' => USer::where('can_vote', '=', 1)->where('vote_status', '=', 1)->count(),
            'polled' => USer::where('can_vote', '=', 1)->where('poll_status', '=', 1)->count(),
        ];
        return $data;
    }

    public function getRegisteredUsers()
    {
        $registeredusers = User::where('uscmpc_id', '=', null)->get();
        return response()->json($registeredusers);
    }

    public function updateElectionStatus1(Request $request)
    {
        $users =  User::where('election_status', '<', 2)->get();
        $i = 0;

        if($users->count() > 0){
            for(; $i < $users->count(); $i++){
                $users[$i]->election_status = 1;
                $users[$i]->save();
            }

            return "Election has started.";
        }else{
            return "Election status error!!";
        }
    }

    public function updateElectionStatus2(Request $request)
    {
        $users = User::all();
        $i = 0;

        if($users->count() > 0){
            for(; $i < $users->count(); $i++){
                $users[$i]->election_status = 2;
                $users[$i]->save();
            }

            return "Election has ended.";
        }else{
            return "Election status error!!";
        }
    }


}
