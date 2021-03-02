<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function list() {
        $candidates = Candidate::join('users', 'candidates.user_id', '=', 'users.id')
                                ->get(['candidates.*', 'users.*']);
        return response()->json($candidates);
    }
}
