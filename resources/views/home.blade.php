@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Project</th>
                                <th>Severity</th>
                                <th>File</th>
                                <th>Method</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                    @if ($logs)
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ \App\Helper::dateToDiff($log->creation_date) }}</td>
                                <td>{{ \App\Models\Project::getProjectName($log->project_id) }}</td>
                                <td>{{ \App\Models\Queue::getSeverityName($log->severity) }}</td>
                                <td>{{ $log->file }}</td>
                                <td>{{ $log->method }}</td>
                                <td width="40%">{{ mb_substr($log->message, 150) }}</td>
                            </tr>
                            {{--{{ dump($log->toArray()) }}--}}
                        @endforeach

                    @endif
                    </table>
                </div>
                <div class="panel-footer">
                    @if ($logs)
                        {{ $logs->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
