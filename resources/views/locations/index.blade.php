{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Users')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <h1> My Location <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Location</th>
                    <th>Date/Time Added</th>
                    <th>Location Roles</th>
                    <th>Location Permissions</th>
                    <th>Operations</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($locations as $location)
                <tr>

                    <td>{{ $location->location }}</td>
                    <td>{{ $location->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{ $location->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                    <td>{{ $location->permissions()->pluck('name')->implode(', ') }}</td>
                    <td>
                    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['locations.destroy', $location->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection