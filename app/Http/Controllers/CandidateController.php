<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function list() {
        $candidates = Candidate::join('users', 'candidates.user_id', '=', 'users.id')
                                ->get(['candidates.id', 'user_id', 'title', 'first_name', 'last_name', 'profile_photo_path']);
        return response()->json($candidates);
    }
}
