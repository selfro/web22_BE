<?php

namespace Database\Seeders;

use App\Models\Coaching;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoachingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coaching = new Coaching();
        $user = User::all()->where('isTutor', '=', 'true')->first(); // 1. tutor
        $coaching->user()->associate($user);

        $offer = Offer::all()->first(); // 1. Angebot
        $coaching->offer()->associate($offer);

        $coaching->save();
    }
}
