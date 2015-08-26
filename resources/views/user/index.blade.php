@extends('templates.dashboard')

@section('title', 'Users')

@section('content')
    <h1>Users</h1>
    <p><a href="{{ url('users/create') }}" class="btn btn-primary">Add New</a></p>
    <table class="table table-striped table-bordered datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Date Registered</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <!-- Split button -->
                        <div class="btn-group">
                            <a href="{{ url('users/edit/'.$user->id.'')  }}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('users/edit/'.$user->id.'') }}">Edit</a></li>
                                <li class="divider"></li>
                                <li>
                                    {!! Former::vertical_open('users/delete/'.$user->id)->method('DELETE')->class('form_delete form-confirm-delete') !!}
                                    <input type="hidden" class="delete-name" name="delete-name" value="{{ $user->email }}" />
                                    <button id="button-delete-{{$user->id}}" type="submit" class="btn btn-danger btn-block btn-xs">Delete</button>
                                    {!! Former::close() !!}
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop