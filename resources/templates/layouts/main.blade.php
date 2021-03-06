<!doctype html>
<html class="no-js" lang="en" ng-app="TaskManager">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Task Manager | Welcome</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    {!! HTML::style('static/css/styles.css') !!}
    {!! HTML::style('static/css/simple-sidebar.css') !!}
    {!! HTML::style('static/css/responsive.css') !!}
    {!! HTML::script('static/js/vendor/modernizr.js') !!}
  </head>
  <body>
   <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="rlcontainer">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            @if(Auth::check())
                <a class="navbar-brand" href="{!! URL::route('assigned.tasks', $attributes = ['username' => Auth::user()->username]) !!}">{!! HTML::image('static/img/logo.png') !!}</a>
            @else
                <a class="navbar-brand" href="/">{!! HTML::image('static/img/logo.png') !!}</a>
            @endif
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="dropdown"><a href="#" id="headerUsername" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>{{ucwords(Auth::user()->first_name)}} {{ucwords(Auth::user()->last_name)}}</span><span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a class="" href="{!! URL::route('auth.logout') !!}">Logout</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Profiles <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <?php App::make('userHelpers')->getUserDropdown(); ?>
                      </ul>
                    </li>
                @else
                    <li><a class="" href="{!! URL::route('auth.login') !!}">Login</a></li>
                    <li><a  href="{!! URL::route('auth.register') !!}">Register</a></li>
                @endif
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

      @if (Session::has('flash_notification.message'))
          @if (Session::has('flash_notification.overlay'))
              @include('partials/_modal', ['modalClass' => 'flash-modal', 'title' => 'Notice', 'body' => Session::get('flash_notification.message')])
          @else
              <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>{{ Session::get('flash_notification.message') }}</h4>
              </div>
          @endif
      @endif


    @yield('content')


    {!! HTML::script('static/js/vendor/jquery.js') !!}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    {!! HTML::script('static/js/acceptTask.js') !!}
    {!! HTML::script('static/js/sidebar.js') !!}
    {!! HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js') !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-route.js') !!}
    {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-resource.js') !!}
    <!-- Menu Toggle Script -->
            <script>
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
            </script>
  </body>
</html>
