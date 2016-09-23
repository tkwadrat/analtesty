@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
        <h2>{{$courseName}}: <span style="color: grey">{{$testName}}</span></h2>

        {!! Form::open(['url' => 'test?email='.$email]) !!}

        <!-- tymczasowe -->
        {!! Form::hidden('userId', $userId) !!}
        {!! Form::hidden('testId', $testId) !!}

        @foreach($questions as $question)
            <h4 style="margin-top:30px;">{{ $question->question }}</h4>
            <div class="form-group" style="margin-left: 10px;">
                <div class="radio">
                    <label>
                        {!! Form::radio('answer'.$question->id, 1) !!} {{ $question->a1 }}
                    </label>
                </div>
                <div class="radio">
                    <label>
                        {!! Form::radio('answer'.$question->id, 2) !!} {{ $question->a2 }}
                    </label>
                </div>
                <div class="radio">
                    <label>
                        {!! Form::radio('answer'.$question->id, 3) !!} {{ $question->a3 }}
                    </label>
                </div>
                <div class="radio">
                    <label>
                        {!! Form::radio('answer'.$question->id, 4) !!} {{ $question->a4 }}
                    </label>
                </div>
            </div>

        @endforeach

        <div class="form-group" style="margin-top: 40px;">
            {{ Form::submit('Wyślij odpowiedź', ['class' => 'btn btn-primary form-control']) }}
        </div>

        {!! Form::close() !!}
        </div>
    </div>
@stop