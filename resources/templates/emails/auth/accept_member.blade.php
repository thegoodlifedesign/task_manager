<h1>Welcome to the world of task managing 2.0</h1>

<h6>Here is the information to the new memebr</h6>

<p>New Member Name: {{$first_name}} {{$last_name}}</p>
<p>New Member Email: {{$email}}</p>
<p>New Member Username: {{$username}}</p>

<h3>Do you Accept <a href="{!! URL::route('auth.accept.user', ['token' => $username]) !!}">Click here</a></h3>