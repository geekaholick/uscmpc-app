<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'uscmpc_id',
        'first_name',
        'middle_name',
        'last_name',
        'vote_status',
        'membership',
        'membership_date',
        'email',
        'id'
    ];
}
