<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Course;
use App\Question;
use App\Test;
use App\UserTest;
use App\User;
use Carbon\Carbon;
use Request;

use App\Http\Requests;

class QuestionController extends Controller
{
    //
    public function test($hash){

        $input = Request::all();

        //sprawdzamy podany adres email
        $email = null;
        if (isset($input['email'])){
            $email = $input['email'];
        } else {
            return view('logintest')->with([
                'hash' => $hash
            ]);
        }

        $user = User::where('email', '=', $email)->first();

        if (isset($user)){
            $userId = $user['id'];
        } else {
            return view('logintest')->with([
                'hash' => $hash,
                'error' => 'Nie ma takiego adresu email'
            ]);
        }


        $test = Test::where('hash', '=', $hash)->firstOrFail(); //TODO: Dodać obsługę gdy nie ma testu
        $testId = $test->id;

        // czy mam prawo do testu?
        $userTest = UserTest::where(['test_id' => $testId, 'user_id' => $userId])->first();

        if ($userTest == null) {
            return view('logintest')->with([
                'hash' => $hash,
                'error' => 'Nie masz prawa do tego testu'
            ]);
        } elseif ($userTest->filled == true) {
            return view('logintest')->with([
                'hash' => $hash,
                'error' => 'Wypełniłeś już ten test'
            ]);
        }

        //czy data nie upłynęła?
        $today = Carbon::now();
        $endDate = Carbon::createFromFormat('Y-m-d', $userTest->end_date);
        //dd($today, $endDate);
        if($today->gt($endDate)) {
            return view('logintest')->with([
                'hash' => $hash,
                'error' => 'Data wypełniania kursu już minęła'
            ]);
        }


        $questions = Question::where('test_id', '=', $testId)->get();

        $course = Course::where('id', '=', $test->course_id)->first();

        return view("test")->with([
            'testId' => $testId,
            'testName' => $test->name,
            'courseName' => $course->name,
            'email' => $email,
            'userId' => $userId,
            'questions' => $questions]);
    }

    public function store() {
        $input = Request::all();

        //sprawdzamy podany adres email
        $email = null;
        if (isset($input['email'])){
            $email = $input['email'];
        } else {
            return view('logintest')->with([
                'hash' => $hash
            ]);
        }

        $user = User::where('email', '=', $email)->first();

        if (isset($user)){
            $userId = $user['id'];
        } else {
            return view('logintest')->with([
                'hash' => $hash
            ]);
        }


        $testId = (int)$input['testId'];
        $userId = (int)$input['userId'];
        $questions = Question::where('test_id', '=', $testId)->get();


        $user_answers = array();

        $score = 0;
        $correctAnswer = 0;
        $numberOfAnswer = count($questions);

        foreach ($questions as $question) {

            if ($input['answer'.$question->id] == $question->correct_answer){
                $score = $score + 1;
                $correctAnswer++;
            }

            $answer = new Answer;
            $answer->user_id = $userId;
            $answer->test_id = $testId;
            $answer->question_id = $question->id;

            $user_answer = (int)$input['answer'.$question->id];
            $answer->answer = $user_answer;
            $user_answers[$question->id] = $user_answer;

            $answer->save();
        }

        $score = (int)($score / count($questions) * 100);

        $userTest = UserTest::where(['test_id' => $testId, 'user_id' => $userId])->first();
        $userTest->score = $score;
        $userTest->filled = true;
        $userTest->save();

        $test = Test::where('id', '=', $testId)->first();
        $course = Course::where('id', '=', $test->course_id)->first();

        return view('result')->with([
            'testName' => $test->name,
            'courseName' => $course->name,
            'questions' => $questions,
            'user_answers' => $user_answers,
            'correctAnswer' => $correctAnswer,
            'numberOfAnswer' => $numberOfAnswer,
            'score' => $score
            ]);
    }

    public function mailchimp() {

    }
    
}
