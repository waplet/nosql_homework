@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h4 class="pull-left">Projects</h4>
            <div class="btn-group pull-right">
                <a href="{{ URL::to('project/' . $project->id . '/users/add') }}"
                   class="btn btn-primary pull-right">Add Project</a>
            </div>
        </div>
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
                    <td>{{ $projectUser->id }}</td>
                    <td>{{ $projectUser->user()->name }}</td>
                    <td>
                        {{ Form::open(['url' => 'project/' . $project->id, 'class' => 'pull-right']) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {{ Form::submit('Delete this Project', ['class' => 'btn btn-warning', 'onClick' => 'return confirm("Delete project?")']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection