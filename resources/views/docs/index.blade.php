@extends('layouts.app')

@section('content')
    <h2>Dokumentācija</h2>
    <div class="panel panel-default">
        <div class="panel-heading"><b>Log record</b></div>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width:20%">URL</td>
                    <td><code>/api/queue/add</code></td>
                </tr>
                <tr>
                    <td>Method</td>
                    <td><code>GET/POST</code></td>
                </tr>
                <tr>
                    <td>POST Data/URL params</td>
                    <td><pre>project_id=[varchar] - required
severity=[integer] - integer|min:0|max:7
creation_date=[datetime] - required|date_format:"Y-m-d H:i:s"</pre>
                        <i>Optional</i>:
                        <pre>
file=[varchar]
message=[varchar]</pre>
                    </td>
                </tr>
                <tr>
                    <td>Severities</td>
                    <td><pre>0 - LOG
1 - DEBUG
2 - NOTICE
3 - WARNING
4 - ERROR
5 - FATAL
6 - CRITICAL
7 - APOCALYPSE</pre></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><b>Usage Example #1</b></div>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width:20%">URL</td>
                    <td><code>/api/queue/add</code></td>
                </tr>
                <tr>
                    <td>POST Data/URL params</td>
                    <td><pre>project_id=asd
severity=4
creation_date=2016-12-12 12:12:12</pre>
                    </td>
                </tr>
                <tr class="bg-danger">
                    <td>Response</td>
                    <td><pre>"Incorrect Project ID specified"</pre></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><b>Usage Example #2</b></div>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width:20%">URL</td>
                    <td><code>/api/queue/add</code></td>
                </tr>
                <tr>
                    <td>POST Data/URL params</td>
                    <td><pre>project_id=5824c228f12901112c004031
severity=4</pre>
                    </td>
                </tr>
                <tr class="bg-danger">
                    <td>Response</td>
                    <td><pre>{"creation_date":["The creation date field is required."]}</pre></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"><b>Usage Example #3</b></div>
        <table class="table">
            <tbody>
                <tr>
                    <td style="width:20%">URL</td>
                    <td><code>/api/queue/add</code></td>
                </tr>
                <tr>
                    <td>POST Data/URL params</td>
                    <td><pre>project_id=5824c228f12901112c004031
severity=4
creation_date=2016-12-12 12:12:12</pre>
                    </td>
                </tr>
                <tr class="bg-success">
                    <td>Response</td>
                    <td><pre>true</pre></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
