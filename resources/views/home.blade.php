@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <table class="table table-condensed" style="table-layout: fixed;width:100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                        <tr class="{{ \App\Helper::getSeverityClass($log->severity) }}">
                            <td style="width:5%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;"><a href="{{ url('/log/' . $log->id) }}" title="{{ $log->id }}">Open</a></td>
                            <td style="width:10%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">{{ \App\Helper::dateToDiff($log->creation_date) }}<br/>
                                <span class="small">{{ $log->creation_date }}</span></td>
                            <td style="width:10%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">{{ \App\Models\Project::getProjectName($log->project_id) }}</td>
                            <td style="width:10%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">{{ \App\Models\Queue::getSeverityName($log->severity) }}</td>
                            <td style="width:20%;overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">{{ mb_substr($log->file,0, 50) . (mb_strlen($log->file) > 50 ? '...' : '') }}</td>
                            <td style="overflow:hidden;white-space: nowrap; text-overflow: ellipsis;">{{ $log->method }}</td>
                            <td style="overflow:hidden;white-space: nowrap; text-overflow: ellipsis;" width="40%">{{ is_array($log->message) ?
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
