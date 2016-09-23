@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>{{$courseName}}: <span style="color: grey">{{$testName}}</span></h2>
            <h3>Wyniki testu: {{$correctAnswer}} / {{$numberOfAnswer}} ({{$score}}%)</h3>

            @foreach($questions as $question)
                <h4 style="margin-top:30px;">
                    @if($question->correct_answer == $user_answers[$question->id])
                        <i class="fa fa-check-circle" aria-hidden="true" style="color: lightgreen"></i>
                    @else
                        <i class="fa fa-times-circle" aria-hidden="true" style="color: red"></i>
                    @endif {{ $question->question }}</h4>

                <ul>
                    <li @if($user_answers[$question->id] == 1) style="font-weight:bold" @endif>

                            {{$question->a1}}

                            @if($user_answers[$question->id] == 1)
                                @if($question->correct_answer == 1)
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                @else
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                @endif
                            @endif
                    </li>
                    <li @if($user_answers[$question->id] == 2) style="font-weight:bold" @endif>

                        {{$question->a2}}

                        @if($user_answers[$question->id] == 2)
                            @if($question->correct_answer == 2)
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times" aria-hidden="true"></i>
                            @endif
                        @endif
                    </li>
                    <li @if($user_answers[$question->id] == 3) style="font-weight:bold" @endif>

                        {{$question->a3}}

                        @if($user_answers[$question->id] == 3)
                            @if($question->correct_answer == 3)
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times" aria-hidden="true"></i>
                            @endif
                        @endif
                    </li>
                    <li @if($user_answers[$question->id] == 4) style="font-weight:bold" @endif>

                        {{$question->a4}}

                        @if($user_answers[$question->id] == 4)
                            @if($question->correct_answer == 4)
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-times" aria-hidden="true"></i>
                            @endif
                        @endif
                    </li>
                </ul>

                @if($user_answers[$question->id] != $question->correct_answer)
                <p><strong style="font-style: italic">Prawidłowa odpowiedź:</strong> {{$question['a'.$question->correct_answer]}}</p>
                @endif
            @endforeach
        </div>
    </div>

@stop