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
                    <label for="taskPriority">Priority</label>
                    <select class="form-control" id="taskPriority" name="priority">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
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