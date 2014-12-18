@extends('layouts.admin')

@section('adminContent')

<div id="assignments">
    @if( ! is_null($tasks))
        @include('partials.tasks-no-button')
    @else
       <a class="btn btn-primary" href="{!! URL::route('add.task') !!}">Add Your First Task</a>
    @endif
</div>
@stop