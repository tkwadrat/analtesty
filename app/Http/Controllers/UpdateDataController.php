<?php

namespace App\Http\Controllers;

use App\Course;
use App\Question;
use App\Test;
use App\User;
use App\UserTest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class UpdateDataController extends Controller
{
    public function addExample(){

        //Add User
        $user = new User;
        $user->name = "Tomek Tomaszewski";
        $user->email = "tet@tet.pl";
        $user->save();

        $course = new Course;
        $course->name = "Kurs adeptów Analizy";
        $course->save();


        $test1 = new Test;
        $test1->hash = "aa1";
        $test1->name = "Test 1";
        $test1->course_id = $course->id;
        $test1->save();

        $test2 = new Test;
        $test2->hash = "aa2";
        $test2->name = "Test 2";
        $test2->course_id = $course->id;
        $test2->save();


        $question1 = new Question;
        $question1->test_id = $test1->id;
        $question1->question = "Pytanie 1";
        $question1->a1 = "Odp1";
        $question1->a2 = "Odp2";
        $question1->a3 = "Odp3 Prawidłowa";
        $question1->a4 = "Odp4";
        $question1->correct_answer = 3;
        $question1->save();

        $question2 = new Question;
        $question2->test_id = $test1->id;
        $question2->question = "Pytanie 1";
        $question2->a1 = "Odp1";
        $question2->a2 = "Odp2 Prawidłowa";
        $question2->a3 = "Odp3";
        $question2->a4 = "Odp4";
        $question2->correct_answer = 2;
        $question2->save();

        $userTest1 = new UserTest;
        $userTest1->user_id = $user->id;
        $userTest1->test_id = $test1->id;
        $userTest1->filled = false;
        $today = Carbon::now();
        $userTest1->start_date = $today->format("Y-m-d");
        $userTest1->end_date = $today->addDays(60)->format("Y-m-d");
        $userTest1->score = 0;
        $userTest1->save();

        $userTest2 = new UserTest;
        $userTest2->user_id = $user->id;
        $userTest2->test_id = $test2->id;
        $userTest2->filled = false;
        $today = Carbon::now();
        $userTest2->start_date = $today->format("Y-m-d");
        $userTest2->end_date = $today->addDays(60)->format("Y-m-d");
        $userTest2->score = 0;
        $userTest2->save();

        echo 'dodane';
    }
}
