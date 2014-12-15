@extends('layouts.admin')

@section('adminContent')

<div class="row">
    <div class="container">
        <div class="col-md-6">
            <h1 class="center">Add Task!</h1>
            <div class="error-message">
                <ul class="list-error">
                     @foreach($errors->all() as $error)
                        <li class="alert-box">{{$error}}</li>
                     @endforeach
                </ul>
            </div>
            {!! Form::open(['files' => true]) !!}
                <input type="hidden" value="{{Auth::user()->id}}" name="assigned_from">
                <div class="form-group">
                    <label for="taskName">Task Name</label>
                    <input type="text" id="taskName" name="title" class="form-control" placeholder="Name of Task">
                </div>
                <div class="form-group">
                    <label for="taskDescription">Task Description</label>
                    <textarea name="description" class="form-control" id="taskDescription" placeholder="Task Descripiton"></textarea>
                </div>
                <div class="form-group">
                    <label for="taskProject">Project Name</label>
                    <select id="taskProject" class="form-control" name="project">
                        <?php App::make('taskFormHelpers')->selectProjects(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php App::make('taskFormHelpers')->selectUsers(); ?>
                </div>
                <div class="form-group">
                    <label for="taskWebsiteLink">Website Link</label>
                    <input type="text" class="form-control" id="taskWebsiteLink" name="website_link">
                </div>
                <div class="form-group">
                    <label for="taskRelatedLink">Related Link</label>
                    <input type="text" class="form-control" id="taskRelatedLink" name="related_link">
                </div>
                <div class="form-group">
                    <label for="taskDueDate">Due Date</label>
                    <input type="date" class="form-control" id="taskDueDate" name="due_date">
                </div>
                <div class="form-group">
                    <label for="taskFile">Task Files</label>
                    <input type="file" name="file_url" value="null" class="form-control" id="taskFile" >
                </div>
                <button class="btn btn-default" type="submit">Add Task</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop