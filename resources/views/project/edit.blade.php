@extends('base')

@section('content')
    {{ Form::model($project, ['route' => ['project.update', $project->id], 'method' => 'PUT']) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('owner', 'Owner') }}
        {{ Form::text('owner', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Nerd Level') }}
        {{ Form::textarea('description',null, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Edit the Nerd!', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}
@endsection