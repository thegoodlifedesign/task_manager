<div id="assignments">
    @if(Auth::user()->username == $username)
        @foreach(array_chunk($tasks->all(), 3) as $row)
            <div class="row">
            <?php $task_id = [];?>
                @foreach($row as $task)
                    <div class="col-md-4">
                        <a href="{!! URL::route('task.detail', $attributes = ['project' => $task->project->slug, 'task' => $task->slug]) !!}">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">{{$task->title}}.</h3>
                          </div>
                          <div class="panel-body">
                            <p>{{$task->description}}</p>
                            <p><strong>Project: </strong>{{$task->project->title}}</p>
                            <p class=""><strong>Priority: </strong>{{$task->priority}}</p>
                            {!! Form::open(['url' => URL::route(''.$stage.'.task')]) !!}
                                <input type="hidden" name="task_id" value="{{$task->id}}">
                                <input class="right btn btn-primary" type="submit" value="<?php echo $stage; ?>">
                            {!! Form::close() !!}
                          </div>
                        </div>
                        </a>
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
                          <div class="panel-heading">
                            <h3 class="panel-title">{{$task->title}}.</h3>
                          </div>
                          <div class="panel-body">
                            <p>{{$task->description}}</p>
                            <p><strong>Project: </strong>{{$task->project->title}}</p>
                            <p class=""><strong>Priority: </strong>{{$task->priority}}</p>
                          </div>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>