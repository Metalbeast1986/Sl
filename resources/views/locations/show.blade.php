@extends('layouts.app')

@section('title', '| View Post')

@section('content')

<div class="container">

    
    <hr>
    <p class="lead">{{ $location->location }} </p>
    <hr>
 
    <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    @can('Edit Post')
    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-info" role="button">Edit</a>
    @endcan
    @can('Delete Post')
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    @endcan


</div>

@endsection