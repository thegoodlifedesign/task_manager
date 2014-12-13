@extends('layouts.admin')

@section('adminContent')

<div id="projects">
    @foreach(array_chunk($projects->all(), 3) as $row)
        <div class="row">
            @foreach($row as $project)
                <a href="{!! URL::route('project.tasks', $attributes = ['project' => $project->slug]) !!}">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">{{$project->title}}.</h3>
                          </div>
                          <div class="panel-body">
                            <p>{{$project->description}}</p>
                          </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endforeach
</div>


@stop