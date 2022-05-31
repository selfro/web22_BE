<?php

namespace Database\Seeders;

use App\Models\Coaching;
use App\Models\Lva;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer = new Offer();
        $date = date_create('04.06.2022');
        $offer->start = date_time_set($date, 7,30);
        $offer->end =  date_time_set($date, 9,00);
        $offer->date = $date;
        $offer->lva = 'Organisationsentwicklung';

        // offer einen tutor zuweisen
        $user = User::all()->where('isTutor','=','1')->first(); // 1. tutor
        $offer->user()->associate($user);
        $offer->save();


        $date1 = date_create('05.06.2022');
        $offer2 = new Offer();
        $offer2->start = date_time_set($date1, 7,30);
        $offer2->end =  date_time_set($date1, 9,00);
        $offer2->date = $date1;
        $offer2->lva = 'Personalentwicklung';


        // offer einen tutor zuweisen
        $user2 = User::all()->where('isTutor','=','1')->last(); // letzter
        $offer2->user()->associate($user2);
        $offer2->save();
    }
}
