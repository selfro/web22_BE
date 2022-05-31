<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user 1 = tutor
        $user = new User();
        $user->firstName = "Susi";
        $user->lastName = "Musterfrau";
        $user->semester = 3;
        $user->email = "s2010456016@fhooe.at";
        $user->password = bcrypt('secret');
        $user->isTutor = true;
        $user->description = "Hallo ich bin Susi. Ich bin Expertin in Sachen KWM. Ich freue mich euch kennenzulernen!";
        $user->image = "https://images.unsplash.com/photo-1499887142886-791eca5918cd?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80";
        $user->save();


        // user 2 = lernender
        $user2 = new User();
        $user2->firstName = "Max";
        $user2->lastName = "Muster";
        $user2->semester = 3;
        $user2->email = "s2010456020@fhooe.at";
        $user2->password = bcrypt('secret');
        $user2->isTutor = false;
        $user2->image = "https://images.unsplash.com/photo-1622554129912-c541b2542385?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80";
        $user2->save();


        // user 3 = tutor
        $user3 = new User();
        $user3->firstName = "Johannes";
        $user3->lastName = "Meister";
        $user3->semester = 6;
        $user3->email = "s1910456007@fhooe.at";
        $user3->password = bcrypt('secret');
        $user3->isTutor = true;
        $user3->image = "https://images.unsplash.com/photo-1529068755536-a5ade0dcb4e8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=881&q=80";
        $user3->save();

        // user 4 = lernender
        $user3 = new User();
        $user3->firstName = "Samuel";
        $user3->lastName = "Haargasser";
        $user3->semester = 3;
        $user3->email = "s2010456013@fhooe.at";
        $user3->password = bcrypt('secret');
        $user3->isTutor = false;
        $user3->image = "https://images.unsplash.com/photo-1584418879404-85eb6c39c30c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=880&q=80";
        $user3->save();
    }
}
