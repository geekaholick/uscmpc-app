<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Poll;

class PollController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poll = new Poll([
            'user_id' => $request->input('voter'),
            'q1' => $request->input('questions')[0]['selected'],
            'q2' => $request->input('questions')[1]['selected'],
        ]);
        $poll->save();

        $user = User::find($request->input('voter'));
        $user->poll_status = 1;
        $user->save();

        return "okay";
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            'agree1'=> Poll::where('q1', '=', 0)->count(),
            'disagree1' => Poll::where('q1', '=', 1)->count(),
            'abstain1' => Poll::where('q1', '=', 2)->count(),
            'agree2'=> Poll::where('q2', '=', 0)->count(),
            'disagree2' => Poll::where('q2', '=', 1)->count(),
            'abstain2' => Poll::where('q2', '=', 2)->count(),
        ];
        return $data;
    }
}
