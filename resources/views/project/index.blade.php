@extends('layouts.app')

@section('content')
    <div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h4 class="pull-left">Projects</h4>
            <div class="btn-group pull-right">
                <a href="{{ URL::to('project/create') }}"
                   class="btn btn-primary pull-right">Add Project</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Project Name</th>
                <th>Project Owner</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $key => $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->owner }}</td>

                    <td>
                        {{ Form::open(['url' => 'project/' . $project->id, 'class' => 'pull-right']) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this Project', ['class' => 'btn btn-warning']) }}
                        {{ Form::close() }}
                        {{--<a class="btn btn-small btn-success" href="{{ URL::to('project/' . $project->id) }}">Show this Nerd</a>--}}
                        <a class="btn btn-small btn-info" href="{{ URL::to('project/' . $project->id . '/edit') }}">Edit this Project</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection