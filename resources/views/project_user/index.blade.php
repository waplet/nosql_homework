@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h4 class="pull-left">Project - {{ $project->name }}</h4>
            <div class="btn-group pull-right">
                <a href="{{ URL::to('project/' . $project->id . '/users/create') }}"
                   class="btn btn-primary pull-right">Add users</a>
            </div>
        </div>
        @if (count($projectUsers) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectUsers as $key => $projectUser)
                <tr>
                    <td>{{ $projectUser->project ? $projectUser->project->id : 'Unknown' }}</td>
                    <td>{{ $projectUser->user ? $projectUser->user->name : 'Unknown'}}</td>
                    <td>
                        {{ Form::open(['url' => 'project/' . $project->id . '/users']) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this association', ['class' => 'btn btn-warning', 'onClick' => 'return confirm("Delete association?")']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <div class="panel-body">
                No users for project.
                <a href="{{ URL::to('project/' . $project->id . '/users/create') }}">Add users</a>
            </div>
        @endif
    </div>
@endsection