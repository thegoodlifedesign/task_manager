@extends('layouts.admin')

@section('adminContent')

<div id="assignments">
    @if(!empty($tasks->toArray()))
        @include('partials.tasks-no-button')
    @else
       <a class="btn btn-primary" href="{!! URL::route('add.task') !!}">Add First Task</a>
    @endif
</div>
@stop