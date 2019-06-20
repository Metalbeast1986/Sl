@extends('layouts.app')

@section('title', '| Create New Comment')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Create New Location</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'locations.store')) }}

        <div class="form-group">
          

            {{ Form::label('location', 'Location') }}
            {{ Form::text('location', null, array('class' => 'form-control')) }}
            <br>
            <div class='form-group'>
                @foreach ($roles as $role)
                    {{ Form::checkbox('roles[]',  $role->id ) }}
                    {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                @endforeach
            </div>
            
            <div class='form-group'>
                @foreach ($permissions as $permission)
                    {{ Form::checkbox('permissions[]',  $permission->id ) }}
                    {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

                @endforeach
            </div>
            {{ Form::submit('Create location', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

@endsection