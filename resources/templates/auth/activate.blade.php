@extends('layouts.main')

@section('content')

<div class="row">
    <div class="container">
        <div class="col-md-6 columns">
                <div id="registerForm">
                    <h4>By clicking "Add Member" you are validating that user: {{$token}} can now join your team</h4>
                    {!! Form::open() !!}
                        <input type="hidden" value="{{$token}}" name="activate_token">
                        <button type="submit" class="btn btn-success">Add Member</button>
                    {!! Form::close() !!}
                    <a href="http://localhost:8080" class="btn btn-danger">Decline</a>
                </div>
            </div>
    </div>
</div>


@stop