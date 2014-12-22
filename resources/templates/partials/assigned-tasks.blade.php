<div id="assignments">
    @if(Auth::user()->username == $username)
        @foreach(array_chunk($tasks->all(), 3) as $row)
            <div class="row">
            <?php $task_id = [];?>
                @foreach($row as $task)
                    <div class="col-md-4">
                            <div class="panel panel-default">
                              <div class="panel-heading panel-heading-<?php echo $task->priority; ?>">
                                <a href="{!! URL::route('task.detail', $attributes = ['project' => $task->project->slug, 'task' => $task->slug]) !!}"><h1 class="panel-title">{{ucwords($task->title)}}.</h1>
                        </a>
                              </div>
                              <div class="panel-body">
                                <div class="body-panel">
                                    <div class="left-body-panel">
                                        <p>{{$task->description}}</p>
                                    </div>
                                    <div class="right-body-panel">
                                        <p><strong>{{$task->project->title}}</strong></p>
                                    </div>
                                </div>
                                <div class="task-options">
                                    @if(App::make('taskHelpers')->isTaskAccepted($task))
                                    {!! Form::open(['url' => URL::route(''.$stage.'.task')]) !!}
                                         <input type="hidden" name="task_id" value="{{$task->id}}">
                                         <input type="hidden" name="completion_time" value="{{$task->taskDetails->completion_time}}">
                                         <button class="check-mark-btn" type="submit">{!! HTML::image('static/img/checkmark.png') !!}</button>
                                    {!! Form::close() !!}
                                    @else
                                        @include('partials.accept-task-modal')
                                        <button type="button" class="check-mark-btn" data-toggle="modal" data-target="#myModal">
                                          {!! HTML::image('static/img/checkmark.png') !!}
                                        </button>
                                        {!! Form::open(['url' => URL::route('deny.task')]) !!}
                                             <input type="hidden" name="task_id" value="{{$task->id}}">
                                             <button class="decline-mark-btn" type="submit">{!! HTML::image('static/img/decline-mark.png') !!}</button>
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                              </div>
                            </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @else
        @foreach(array_chunk($tasks->all(), 3) as $row)
            <div class="row">
            <?php $task_id = [];?>
                @foreach($row as $task)
                    <div class="col-md-4">
                        <a href="{!! URL::route('task.detail', $attributes = ['project' => $task->project->slug, 'task' => $task->slug]) !!}">
                            <div class="panel panel-default">
                              <div class="panel-heading panel-heading-<?php echo $task->priority; ?>">
                                <h1 class="panel-title">{{ucwords($task->title)}}.</h1>
                              </div>
                              <div class="panel-body">
                                <div class="body-panel">
                                    <div class="left-body-panel">
                                        <p>{{$task->description}}</p>
                                    </div>
                                    <div class="right-body-panel">
                                        <p><strong>{{$task->project->title}}</strong></p>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>