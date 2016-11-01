@extends('base')

@section('content')
    <h1>Create a Project</h1>

    <!-- if there are creation errors, they will show here -->

    {{--{{ Form::open() }}--}}
    {!! Form::open(['url' => 'project']) !!}

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
        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Create the Project!', ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}
@endsection