<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\User;

class ElectionController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        for($ndx=0; $ndx<count($request->input('candidates')); $ndx++){
            $election = new Election([
                'voter_id' => $request->input('voter'),
                'candidate_id' => $request->input('candidates')[$ndx]
            ]);

            $election->save();
        }
        $user = User::find($request->input('voter'));
        $user->vote_status = 1;
        $user->save();

        return "Vote done";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getResults()
    {

        $data = [
            Election::where('candidate_id', '=', 1)->count(),
            Election::where('candidate_id', '=', 2)->count(),
            Election::where('candidate_id', '=', 3)->count(),
            Election::where('candidate_id', '=', 4)->count(),
            Election::where('candidate_id', '=', 5)->count(),
            Election::where('candidate_id', '=', 6)->count(),
            Election::where('candidate_id', '=', 7)->count(),
        ];
        return $data;
    }
}
