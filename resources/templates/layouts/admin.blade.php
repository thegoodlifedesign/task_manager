@extends('layouts.main')

@section('content')

<div id="adminWrapper">
     <div id="wrapper">
        <?phpdd($tasks);?>
            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <div id='cssmenu'>
                <ul>
                   <li class='has-sub'><a id="taskIcon" class="sidebar-icons" href='#'><span>Tasks<i id="sidebarBottomArrow" class="fa fa-chevron-down"></i></span></a>
                      <ul>
                         <li><a href="{!! URL::route('completed.tasks', $attributes = ['username' => Route::input('username') ?: Auth::user()->username]) !!}"><span>Completed Tasks</span></a></li>
                         <li><a href="{!! URL::route('started.tasks', $attributes = ['username' => Route::input('username') ?: Auth::user()->username]) !!}"><span>Stared Tasks</span></a></li>
                         <li><a href="{!! URL::route('accepted.tasks', $attributes = ['username' => Route::input('username') ?: Auth::user()->username]) !!}"><span>Accepted Tasks</span></a></li>
                         <li class='last'><a href="{!! URL::route('assigned.tasks', $attributes = ['username' => Route::input('username') ?: Auth::user()->username]) !!}"><span>Assigned Tasks</span></a></li>
                      </ul>
                   </li>
                   <li class='has-sub'><a id="projectIcon" class="sidebar-icons" href='#'><span>Projects<i id="sidebarBottomArrow" class="fa fa-chevron-down"></i></span></a>
                      <ul>
                         <li><a href='#'><span>Company</span></a></li>
                         <li class='last'><a href='#'><span>Contact</span></a></li>
                      </ul>
                   </li>
                   <li class='has-sub'><a id="addressBookIcon" class="sidebar-icons" href='#'><span>Address Book<i id="sidebarBottomArrow" class="fa fa-chevron-down"></i></span></a>
                      <ul>
                         <li><a href='#'><span>Company</span></a></li>
                         <li class='last'><a href='#'><span>Contact</span></a></li>
                      </ul>
                   </li>
                   <li class='has-sub'><a id="printIcon" class="sidebar-icons" href='#'><span>Print<i id="sidebarBottomArrow" class="fa fa-chevron-down"></i></span></a>
                      <ul>
                         <li><a href='#'><span>Company</span></a></li>
                         <li class='last'><a href='#'><span>Contact</span></a></li>
                      </ul>
                   </li>
                   <li class='has-sub'><a id="addIcon" class="sidebar-icons" href='#'><span>Add<i id="sidebarBottomArrow" class="fa fa-chevron-down"></i></span></a>
                      <ul>
                         <li><a href='#'><span>Company</span></a></li>
                         <li class='last'><a href='#'><span>Contact</span></a></li>
                      </ul>
                   </li>
                </ul>
                </div>
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