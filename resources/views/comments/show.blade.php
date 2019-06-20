@extends('layouts.app')

@section('title', '| View Post')

@section('content')

<div class="container">

    
    <hr>
    <p class="lead">{{ $comment->body }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['comments.destroy', $comment->id] ]) !!}
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        @if( (Gate::check('Edit Post') || Gate::check('Modify')) )
        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-info" role="button">Edit</a>
        @endif

        @if( (Gate::check('Delete Post') || Gate::check('Administer roles & permissions')) )
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        @endif
    
    {!! Form::close() !!}

</div>

@endsection