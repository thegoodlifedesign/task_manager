@extends('layouts.admin')

@section('adminContent')
<div class="row">
    <div class="container">
        <div class="col-md-6">
            <h1 class="center">Update Task!</h1>
            <div class="error-message">
                <ul class="list-error">
                     @foreach($errors->all() as $error)
                        <li class="alert-box">{{$error}}</li>
                     @endforeach
                </ul>
            </div>
            {!! Form::model($task, ['files' => true]) !!}
                <input type="hidden" value="{{Auth::user()->id}}" name="assigned_from">
                <input type="hidden" value="{{$task->id}}" name="id">
                <div class="form-group">
                    <label for="taskName">Task Name</label>
                    <input type="text" id="taskName" name="title" value="{{$task->title}}" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="taskDescription">Task Description</label>
                    <textarea name="description" class="form-control"  id="taskDescription" >{{$task->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="taskProject">Project Name</label>
                    <select id="taskProject" class="form-control" name="project">
                        <?php App::make('taskFormHelpers')->updateProjects($task->project); ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php App::make('taskFormHelpers')->updateUsers($task); ?>
                </div>
                <div class="form-group">
                    <label for="taskRelatedLink">Related Link</label>
                    <input type="text" class="form-control" id="taskRelatedLink" name="related_link" value="{{$task->taskDetails->related_link}}">
                </div>
                <div class="form-group">
                    <label for="taskWebsiteLink">Website Link</label>
                    <input type="text" class="form-control" id="taskWebsiteLink" name="website_link" value="{{$task->taskDetails->website_link}}">
                </div>
                <div class="form-group">
                    <label for="taskDueDate">Website Link</label>
                    <input type="date" class="form-control" id="taskDueDate" name="due_date" value="{{$task->taskDetails->due_date}}">
                </div>
                <button class="btn btn-primary" type="submit">Update Task</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop