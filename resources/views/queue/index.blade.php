@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h4 class="pull-left">Temporary log info</h4>
            <div class="btn-group pull-right">
                <a href="{{ URL::to('/home') }}"
                   class="btn btn-primary pull-right">To dashboard</a>
            </div>
        </div>
        @if (count($queueItems) > 0)
        <table class="table">
            <thead>
            <tr>
                <th>Insert date</th>
                <th>Project</th>
                <th>Severity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($queueItems as $key => $queueItem)
                <tr>
                    <td>{{ $queueItem->created_at }}</td>
                    <td>{{ \App\Models\Project::getProjectName($queueItem->project_id) }}</td>
                    <td>{{ $queueItem->severity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <div class="panel-body">
                No temporary events hanging
                <a href="{{ URL::to('/home') }}">To dashboard</a>
            </div>
        @endif
    </div>
@endsection