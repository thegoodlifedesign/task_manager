@extends('layouts.admin')

@section('adminContent')
    <div class="row">
        <div class="col-md-6">
            <div class="task-info">
                <div class="task-title">
                    <h1>{{ucwords($task->title)}}</h1>
                    <p>{{$task->description}}</p>
                    @if(App::make('userHelpers')->isUserTaskOwner($task))
                        <a class="btn btn-default " href="{!! URL::route('update.task', $attributes = ['project' => $task->project->slug, 'task' => $task->slug]) !!}">Update</a>
                            @if(!App::make('taskHelpers')->isTaskAccepted($task))
                                <h3 class="panel-title">
                                    {!! Form::open(['url' => URL::route('delete.task')]) !!}
                                        <input type="hidden" name="task_id" value="{{$task->id}}">
                                        <input class="right btn btn-danger" type="submit" value="Delete">
                                    {!! Form::close() !!}
                                </h3>
                            @endif
                    @endif
                </div>
                <div class="task-stats">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Assigned By:&nbsp;</th>
                            <td>{{$task->assignee->username}}</td>
                        </tr>
                        <tr>
                        <th>Related Link:&nbsp;</th>
                             @if($task->taskDetails->website_link == null)
                                 <td>No website links</td>
                             @else
                                 <td><a target="_blank" href="{{$task->taskDetails->website_link}}">Website link</a></td>
                             @endif
                        </tr>
                        <tr>
                            <th>Related Link:&nbsp;</th>
                            @if($task->taskDetails->related_link == null)
                                <td>No related links</td>
                            @else
                                <td><a target="_blank" href="{{$task->taskDetails->related_link}}">Related Link</a></td>
                            @endif
                        </tr>
                        <tr>
                            <th>Due Date:&nbsp;</th>
                            <td>{{$task->taskDetails->due_date}}</td>
                        </tr>
                        <tr>
                            <th>Files:&nbsp;</th>
                            @if(App::make('taskHelpers')->TaskHasFile($task))
                                <td><a href="/media/file_uploads/<?php echo $task->file_url ?>"><i class="icon-download-alt"> </i> Download File</a></td>
                            @else
                                <td>no files</td>
                            @endif
                        </tr>
                    </table>
                    @if(App::make('taskHelpers')->userAssignedTask($task))
                        {!! Form::open(['url' => URL::route('accept.task')]) !!}
                            <input type="hidden" name="task_id" value="{{$task->id}}">
                            <input class="btn btn-primary" type="submit" value="accept">
                        {!! Form::close() !!}
                    @endif
                    @if(App::make('taskHelpers')->userAcceptedTask($task))
                        {!! Form::open(['url' => URL::route('start.task')]) !!}
                            <input type="hidden" name="task_id" value="{{$task->id}}">
                            <input type="submit" class="btn btn-primary" value="Start!">
                        {!! Form::close() !!}
                    @endif
                    @if(App::make('taskHelpers')->userStartedTask($task))
                        {!! Form::open(['url' => URL::route('complete.task')]) !!}
                            <input type="hidden" name="task_id" value="{{$task->id}}">
                            <input type="submit" class="btn btn-primary" value="Completed!">
                        {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-body">
                <h1 class="center">Comments</h1>
              </div>
              @foreach($task->comments as $comment)
                <div class="panel-footer">{{$comment->comment}}<p class="right">{{($comment->author->username)}}</p></div>
              @endforeach
              {!! Form::open(['url' => URL::route('add.task.comment')]) !!}
                  <input type="hidden" name="task_id" value="{{ $task->id }}">
                  <textarea class="panel-footer" id="taskCommentTextarea" name="comment" placeholder="Enter your comment here..."></textarea>
                  <button type="submit" class="btn btn-primary">Add Comment</button>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
