<div id="assignments">
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
</div>