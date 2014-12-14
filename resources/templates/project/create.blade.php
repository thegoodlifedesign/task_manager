@extends('layouts.admin')

@section('adminContent')

<div class="row">
    <div class="container">
        <div class="col-md-6">
            <h1 class="center">Add Project!</h1>
            <div class="error-message">
                <ul class="list-error">
                     @foreach($errors->all() as $error)
                        <li class="alert-box">{{$error}}</li>
                     @endforeach
                </ul>
            </div>
            {!! Form::open() !!}
                <div class="form-group">
                    <label for="projectName">Project Name</label>
                    <input type="text" id="projectName" name="title" class="form-control" placeholder="Name of Project">
                </div>
                <div class="form-group">
                    <label for="projectDescription">Project Description</label>
                    <textarea name="description" class="form-control" id="projectDescription" placeholder="Project Descripiton"></textarea>
                </div>
                <button class="btn btn-default" type="submit">Add Project</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop