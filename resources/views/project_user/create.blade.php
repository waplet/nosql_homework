@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h4 class="pull-left">Add user to project - {{ $project->name }}</h4>
            <div class="btn-group pull-right">
                <a href="{{ URL::to('project/' . $project->id . '/users') }}"
                   class="btn btn-danger pull-right">Back</a>
            </div>
        </div>
        <div class="panel-body">
            <!-- if there are creation errors, they will show here -->

            {{--{{ Form::open() }}--}}
            {!! Form::open(['url' => 'project/' . $project->id . '/users']) !!}

            <div class="row col-md-6">
                <div class="form-group">
                    {{ Form::label('user_id', 'User') }}
                    {{ Form::select('user_id', $users, null, ['class' => 'form-control', 'placeholder' => 'Select an user']) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Assign user for project!', ['class' => 'btn btn-primary']) }}
                </div>
            </div>

            {{ Form::close() }}
        </div>
    </div>

@endsection