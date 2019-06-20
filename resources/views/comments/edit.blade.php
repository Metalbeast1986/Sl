@extends('layouts.app')

@section('title', '| Edit Comment')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <h1>Edit Comments</h1>
        <hr>
            {{ Form::model($comment, array('route' => array('comments.update', $comment->id), 'method' => 'PUT')) }}
            <div class="form-group">
           
            {{ Form::label('body', 'Comment') }}
            {{ Form::textarea('body', null, array('class' => 'form-control')) }}<br>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
    </div>
    </div>
</div>

@endsection