@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h4 class="pull-left">Projects</h4>
            <div class="btn-group pull-right">
                <a href="{{ URL::to('project/') }}"
                   class="btn btn-danger pull-right">Back</a>
            </div>
        </div>
        <div class="panel-body">
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
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description',null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('has_booking', 'Has booking?') }}
                {{ Form::checkbox('has_booking', 1, false, ['class' => 'checkbox']) }}
            </div>

            {{ Form::submit('Edit the project!', ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>
@endsection