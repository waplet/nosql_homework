@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading"><b>Log record</b></div>
        <table class="table">
            <tr>
                <td style="width:10%"><b>ID</b></td>
                <td>{{ $errorLog->id }}</td>
            </tr>
            <tr>
                <td><b>Date</b></td>
                <td>{{ $errorLog->creation_date }}</td>
            </tr>
            <tr>
                <td><b>Project</b></td>
                <td>{{ \App\Models\Project::getProjectName($errorLog->project_id) }}</td>
            </tr>
            <tr>
                <td><b>Severity</b></td>
                <td>{{ \App\Models\Queue::getSeverityName($errorLog->severity) }}</td>
            </tr>
            <tr>
                <td><b>File</b></td>
                <td>{{ $errorLog->file }}</td>
            </tr>
            <tr>
                <td><b>Method</b></td>
                <td>{{ $errorLog->method }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top;" colspan="2"><b>Message</b></td>

            </tr>
            <tr>
                <td colspan="2">asd{{ $errorLog->message }}</td>
            </tr>
        </table>
    </div>
@endsection