@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-6">

            <h2 style="margin-bottom: 30px;">Zaloguj się do testu</h2>

            {!! Form::open(['url' => 'test/'.$hash, 'method' => 'get']) !!}

            <div class="form-group">
                {!! Form::label('email', 'E-mail kursanta:') !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'example@example.com']) !!}
            </div>

            @if(isset($error))
                <ul class="aler alert-danger">
                    <li>{{$error}}</li>
                </ul>
            @endif

            <div class="form-group">
                {!! Form::submit('Rozpocznij test', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <div class="col-md-6"></div>
    </div>

@stop