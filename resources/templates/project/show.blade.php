@extends('layouts.admin')

@section('adminContent')

<div id="assignments">
    @if(!empty($tasks->toArray()))
        @foreach(array_chunk($tasks->all(), 3) as $row)
            <div class="row">
                @foreach($row as $task)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">{{$task->title}}.</h3>
                          </div>
                          <div class="panel-body">
                            <p>{{$task->description}}</p>
                            <p><strong>Project: </strong>{{$task->project->title}}</p>
                            <p class=""><strong>Priority: </strong>{{$task->priority}}</p>
                            <p class="right"><strong>Stage: </strong>{{$task->stage}}</p>
                            <a href="{!! URL::route('task.detail', $attributes = ['project' => $task->project->slug, 'task' => $task->slug]) !!}">Details</a>
                          </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @else
       <a class="btn btn-primary" href="{!! URL::route('add.task') !!}">Add First Task</a>
    @endif
</div>
@stop