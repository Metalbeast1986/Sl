@extends('layouts.app')
@section('title', '| Create New Comment')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Create New comment</h1>
            <hr>
            {{-- Using the Laravel HTML Form Collective to create our form --}}
            {{ Form::open(array('route' => 'comments.store')) }}
            <div class="form-group">
                {{ Form::label('comment', 'Comment') }}
                {{ Form::textarea('body', null, array('class' => 'form-control')) }}
                <br>
                {{ Form::submit('Create comment', array('class' => 'btn btn-success btn-lg btn-block')) }}
                
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection