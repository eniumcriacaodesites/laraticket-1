@extends('templates.dashboard')

@section('title', 'Clients')

@section('content')
    <h1>Clients</h1>
    <p><a href="{{ url('clients/create') }}" class="btn btn-primary">Add New</a></p>
    <table class="table table-striped table-bordered datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date Created</th>
                <th>Created By</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ date('F d, Y', strtotime($client->created_at)) }}</td>
                    <td>
                        @if($client->user)
                        {{ $client->user->email }}
                        @endif
                    </td>
                    <td>
                        <!-- Split button -->
                        <div class="btn-group">
                            <a href="{{ url('clients/edit/'.$client->id.'')  }}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('clients/edit/'.$client->id.'') }}">Edit</a></li>
                                <li class="divider"></li>
                                <li>
                                    {!! Former::vertical_open('clients/delete/'.$client->id)->method('DELETE')->class('form_delete form-confirm-delete') !!}
                                    <input type="hidden" class="delete-name" name="delete-name" value="{{ $client->name }}" />
                                    <button id="button-delete-{{$client->id}}" type="submit" class="btn btn-danger btn-block btn-xs">Delete</button>
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