@extends('layouts.app')

@section('content')
    <h2>Dokumentācija</h2>
    <div class="panel panel-default">
        <div class="panel-heading"><h3>Log record</h3></div>
        <div class="panel-body">
             <ul>
        <li>URL:</li>
        <p>/api/queue/add</p>
	<li>Method:</li>
	<p>GET/POST</p>
	<li>URL Params:</li>
	<p>project_id=[varchar]</p>
	<p>severity=[integer]</p>
	<p>creation_date=[datetime]</p>
	<p>Optional:</p>
	<p>file=[varchar]</p>
	<p>method=[varchar]</p>
	<p>message=[varchar]</p>
	<li>Sample usage</li>
	<p><br/><code>/api/queue/add?project_id=129b0asd01asd012&severity=3&creation_date=2016-11-09 12:34:56&file=index.php&method=runFile()&message=Uncaught ErrorException: Incorrect filename specified</code></p>
    </ul>
        </div>
    </div>  
   
    <h3>Log record</h3>
@endsection
