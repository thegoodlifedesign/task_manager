@extends('layouts.main')

@section('content')

<div id="adminWrapper">
    <div id="sideBar">
        <ul class="nav nav-sidebar">
            <li><a href="{!! URL::route('projects') !!}">Projects</a></li>
            <li><a href="{!! URL::route('add.task') !!}">Add Task</a></li>
            <li><a href="{!! URL::route('completed.tasks', $attributes = ['username' => Auth::user()->username]) !!}">Completed Tasks</a></li>
            <li><a href="{!! URL::route('started.tasks', $attributes = ['username' => Auth::user()->username]) !!}">Started Tasks</a></li>
            <li><a href="{!! URL::route('accepted.tasks', $attributes = ['username' => Auth::user()->username]) !!}">Accepted Tasks</a></li>
            <li><a href="{!! URL::route('assigned.tasks', $attributes = ['username' => Auth::user()->username]) !!}">Assigned Tasks</a></li>        </ul>
    </div>
    <div id="mainBody">
        @yield('adminContent')
    </div>
</div>


@stop