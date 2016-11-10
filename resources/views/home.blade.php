@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <table class="table table-condensed"
                    style="overflow:hidden;white-space: nowrap; text-emphasis: circle;">
                    <thead>
                        <tr>
                            <th style="width:5%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">ID</th>
                            <th style="width:10%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">Date</th>
                            <th style="width:10%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">Project</th>
                            <th style="width:10%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">Severity</th>
                            <th style="width:20%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">File</th>
                            <th style="overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">Method</th>
                            <th style="overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">Message</th>
                        </tr>
                    </thead>
                @if ($logs)
                    @foreach ($logs as $log)
                        <tr class="{{ \App\Helper::getSeverityClass($log->severity) }}">
                            <td><a href="{{ url('/log/' . $log->id) }}" title="{{ $log->id }}">Open</a></td>
                            <td>{{ \App\Helper::dateToDiff($log->creation_date) }}<br/>
                                <span class="small">{{ $log->creation_date }}</span></td>
                            <td>{{ \App\Models\Project::getProjectName($log->project_id) }}</td>
                            <td>{{ \App\Models\Queue::getSeverityName($log->severity) }}</td>
                            <td>{{ mb_substr($log->file,0, 50) . (mb_strlen($log->file) > 50 ? '...' : '') }}</td>
                            <td>{{ $log->method }}</td>
                            <td width="40%">{{ is_array($log->message) ?
                                str_replace("\n", "", mb_substr(print_r($log->message, true), 0, 150)) :
                                str_replace("\n", "", trim(mb_substr($log->message, 0, 150))) }}</td>
                        </tr>
                        {{--{{ dump($log->toArray()) }}--}}
                    @endforeach

                @endif
                </table>
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
