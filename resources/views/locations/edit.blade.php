{{-- \resources\views\users\edit.blade.php --}}

@extends('layouts.app')

@section('title', '| Edit User')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Edit {{$location->location}}</h1>
    <hr>

    {{ Form::model($location, array('route' => array('locations.update', $location->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

    <div class="form-group">
        {{ Form::label('location', 'Location') }}
        {{ Form::text('location', null, array('class' => 'form-control')) }}
    </div>


    <h5><b>Give Role</b></h5>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $location->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

    <h5><b>Give permission</b></h5>

    <div class='form-group'>
  
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id, $location->permissions ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

        @endforeach
    </div>


    <div class="form-group">
        {{ Form::label('password', 'Password') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}

    </div>

    <div class="form-group">
        {{ Form::label('password', 'Confirm Password') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection