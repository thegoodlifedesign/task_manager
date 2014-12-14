@extends('layouts.main')

@section('content')

<div id="adminWrapper">
     <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand"><a href="#">Task Manager Menu</a></li>
                    <li><a href="{!! URL::route('projects') !!}">Projects</a></li>
                    <li><a href="{!! URL::route('add.task') !!}">Add Task</a></li>
                    <li><a href="{!! URL::route('completed.tasks', $attributes = ['username' => Auth::user()->username]) !!}">Completed Tasks</a></li>
                    <li><a href="{!! URL::route('started.tasks', $attributes = ['username' => Auth::user()->username]) !!}">Started Tasks</a></li>
                    <li><a href="{!! URL::route('accepted.tasks', $attributes = ['username' => Auth::user()->username]) !!}">Accepted Tasks</a></li>
                    <li><a href="{!! URL::route('assigned.tasks', $attributes = ['username' => Auth::user()->username]) !!}">Assigned Tasks</a></li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="toggleMenu">
                                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Menu</a>
                            </div>
                            @yield('adminContent')
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->
</div>


@stop