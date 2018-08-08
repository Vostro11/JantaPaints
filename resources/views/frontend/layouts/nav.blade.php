<nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{url('/')}}">{{Config::get('app.name')}}</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Gallery<span class="caret"></span></a>
            <ul class="dropdown-menu">
            
            </ul>

          </li>
          
        <li><a href="{{url('upload')}}">Upload</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(auth()->check())
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Myimages<span class="caret"></span></a>
            <ul class="dropdown-menu">
              @foreach($userImages as $userImages)
              <li><a href="{{url('image-processing/'.$userImages['id'])}}">{{$userImages['image']}}</a></li>
              @endforeach
            </ul>

          </li>
        <li><a href="{{url('#')}}"><span class="glyphicon glyphicon-picture"></span> Profile</a></li>
        <li><a href="{{url('admin/logout')}}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        @else
        <li><a href="{{url('register')}}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="{{url('login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        
        @endif
      </ul>
    </div>
  </nav>