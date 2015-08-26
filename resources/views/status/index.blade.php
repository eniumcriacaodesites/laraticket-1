@extends('templates.dashboard')

@section('title', 'Statuses')

@section('content')
    <h1>Statuses</h1>
    <p><a href="{{ url('statuses/create') }}" class="btn btn-primary">Add New</a></p>
    <table class="table table-striped table-bordered datatable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Weight</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
                <tr>
                    <td>{{ $status->name }}</td>
                    <td>{{ $status->weight }}</td>
                    <td>
                        <!-- Split button -->
                        <div class="btn-group">
                            <a href="{{ url('statuses/edit/'.$status->id.'')  }}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('statuses/edit/'.$status->id.'') }}">Edit</a></li>
                                <li class="divider"></li>
                                <li>
                                    {!! Former::vertical_open('statuses/delete/'.$status->id)->method('DELETE')->class('form_delete form-confirm-delete') !!}
                                    <input type="hidden" class="delete-name" name="delete-name" value="{{ $status->name }}" />
                                    <button id="button-delete-{{$status->id}}" type="submit" class="btn btn-danger btn-block btn-xs">Delete</button>
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