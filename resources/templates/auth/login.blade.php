@extends('layouts.main')


@section('content')

 <div class="container">

       {!! Form::open(['class' => 'form-signin']) !!}
         <h2 class="form-signin-heading">Please sign in</h2>
         <input type="text" name="username" class="form-control" placeholder="Email address" required autofocus>
         <input type="password" name="password" class="form-control" placeholder="Password" required>
         <label class="checkbox">
           <input type="checkbox" name="remember_me" value="remember-me"> Remember me
         </label>
         <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
       {!! Form::close() !!}

 </div> <!-- /container -->

@stop