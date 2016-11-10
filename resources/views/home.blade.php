@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <table class="table table-condensed log-table" style="table-layout: fixed;width:100%;">
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
                            <td class="item"><a href="{{ url('/log/' . $log->id) }}" title="{{ $log->id }}">Open</a></td>
                            <td class="item" style="width:10%;">{{ \App\Helper::dateToDiff($log->creation_date) }}<br/>
                                <span class="small">{{ $log->creation_date }}</span></td>
                            <td class="item" style="width:10%;">{{ \App\Models\Project::getProjectName($log->project_id) }}</td>
                            <td class="item" style="width:10%;">{{ \App\Models\Queue::getSeverityName($log->severity) }}</td>
                            <td class="item" style="width:20%;">{{ mb_substr($log->file,0, 50) . (mb_strlen($log->file) > 50 ? '...' : '') }}</td>
                            <td class="item" style="">{{ $log->method }}</td>
                            <td class="item" style="width:30%;">{{ is_array($log->message) ?
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
