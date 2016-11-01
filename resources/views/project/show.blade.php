@extends('base')

@section('content')
    <div class="jumbotron text-center">
        <h2>{{ $project->name }}</h2>
        <p>
            <strong>Owner:</strong> {{ $project->owner }}<br>
            <strong>Description:</strong> {{ $project->description }}
        </p>
    </div>
@endsection