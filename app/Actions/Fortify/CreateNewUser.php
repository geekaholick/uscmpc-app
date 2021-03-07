<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use DateTime;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $date1 = new DateTime('2021-03-2T21:30:0');
        $date2 = now();

        return User::create([
            'title' => $input['title'],
            'first_name' => $input['first_name'],
            'middle_name' => $input['middle_name'],
            'last_name' => $input['last_name'],
            'membership' => "Regular",
            'membership_date' => now(),
            'can_vote' => new DateTime('2021-03-2T15:30:0') > new DateTime(), //15 => 11PM
            'vote_status' => false,
            'type' => 10,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }

    public function test() {
        $date1 = new DateTime('2021-03-2T14:30:0');
        $date2 = new DateTime();
        $dates = [$date1, $date2,  $date1 > $date2];
        return $dates;
    }
}
