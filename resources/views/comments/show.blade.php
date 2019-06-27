@extends('layouts.app')

@section('title', '| View Post')

@section('content')

<div class="container">

    
    <hr>
    <p class="lead">{{ $comment->body }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['comments.destroy', $comment->id] ]) !!}
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        @if (Gate::check('comment_update'))
        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-info" role="button">Edit</a>
        @endif

        @if( (Gate::check('comment_delete') || Gate::check('Administer roles & permissions')) )
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        @endif
     
    {!! Form::close() !!}

</div>

@endsection