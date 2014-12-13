@extends('layouts.main')


@section('content')

 <div class="row">
    <div class="container">
        <div class="col-md-8">
            <div class="register-title">
                <h2 class="center">Register Below!</h2>
            </div>
            <div class="error-message">
                <ul class="list-error">
                @foreach($errors->all() as $error)
                    <li class="alert-box">{{$error}}</li>
                @endforeach
                </ul>
            </div>
            {!! Form::open() !!}
                <div class="form-group">
                    <label for="registerFirstName">First Name</label>
                    <input type="text" id="registerFirstName" name="first_name" class="form-control" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="registerLastName">Last Name</label>
                    <input type="text" id="registerFirstName" name="last_name" class="form-control" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="registerUsername">Username</label>
                    <input type="text" id="registerUsername" name="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email Address</label>
                    <input type="email" id="registerEmail" name="email" class="form-control" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="registerPassword">Password</label>
                    <input type="password" id="registerPassword" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="registerConfirmPassword">Confirm Password</label>
                    <input type="password" id="registerConfirmPassword" name="confirm_password" class="form-control" placeholder="Confirm Password">
                </div>

                <input type="submit" value="Sign Up" class="btn btn-default">
             {!! Form::close() !!}
        </div>
    </div>

 </div>

@stop