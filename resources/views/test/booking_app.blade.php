@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h4 class="pull-left">Booking App testing</h4>
        </div>
        <div class="panel-body">
            @foreach($bookingProjects as $key => $project)
                <a href="/api/queue/add?project_id={{ $project->id }}&creation_date={{ date('Y-m-d H:i:s') }}&severity=5&file={{ $project->title }}&message=test"
                   class="{{ $key % 3 != 0 ? 'col-md-offset-2' : '' }} col-md-2 btn btn-primary">{{ $project->name }}</a>
                {{--<a href="#lmt" class="col-md-2 btn btn-primary">LMT</a>--}}
                {{--<a href="#tele2" class="col-md-2 col-md-offset-3 btn btn-primary">Tele2</a>--}}
                {{--<a href="#bite" class="col-md-2 col-md-offset-3 btn btn-primary">Bite</a>--}}
            @endforeach
        </div>
    </div>
@endsection