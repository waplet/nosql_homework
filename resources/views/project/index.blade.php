@extends('base')

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Project Name</td>
            <td>Project Description</td>
            <td>Project Owner</td>
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
                    <a class="btn btn-small btn-success" href="{{ URL::to('project/' . $project->id) }}">Show this Nerd</a>
                    <a class="btn btn-small btn-info" href="{{ URL::to('project/' . $project->id . '/edit') }}">Edit this Nerd</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection