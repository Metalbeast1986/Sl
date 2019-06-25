@extends('layouts.app')

@section('title', '| View Post')

@section('content')

<div class="container">

    <h1>{{ $post->title }}</h1>
    <hr>
    <p class="lead">{{ $post->body }} </p>
    <hr>
    {!! Form::open(['method' => 'DELETE', 'route' => ['posts.destroy', $post->id] ]) !!}
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
        
        @if( (Gate::check('Edit Post') || Gate::check('Modify')) )

        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info" role="button">Edit</a>
    
        @endif

        @if( (Gate::check('Delete Post') || Gate::check('Administer roles & permissions')) )

        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        @endif
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

</div>

@endsection