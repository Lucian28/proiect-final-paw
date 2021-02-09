{{-- <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">{{config('app.name','LSAPP')}} </a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="/">Home</a></li>
          <li><a href=#>About</a></li>
          <li><a href=#>Services</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav> --}}


  {{-- PANA AICI GIONULE }}
  {{-- <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/">{{config('app.name','LSAPP')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/services">Service</a>
          </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav> --}}

{{-- PANA AICI GIONULE --}}










  <nav  class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top"   >
    <div class="container-fluid"  >
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                 
            </ul>
           
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a  class="nav-link" href="/">Acasa</a>
              </li>
              @if(Auth::user())
              <li class="nav-item active">
                <a  class="nav-link" href="/about">Comentarii</a>
              </li>
              @endif
              {{-- <li class="nav-item active">
                <a  class="nav-link" href="/services">Services</a>
              </li> --}}
              <li class="nav-item active">
                <a  class="nav-link" href="/posts">Postari</a>
              </li>
             
            </ul>
           
             <ul class=" navbar-nav navbar-right">
              
             </ul>
  
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav navbar-right ">
                <!-- Authentication Links -->
              
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                <li class="nav-item" style="padding-top:15px; padding-right:10px">
                @include('inc.search')
                </li>
                <li class="nav-item" >
                  <a class="nav-link "  href="/posts/create" style="color: rgb(182, 255, 148)"> <b> Pune o intrebare </b></a></li>
                  </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position: relative; padding-left:50px">
                          <img src="/imagini/{{Auth::user()->imagine}}" style="width:32px; height:32px; position: absolute; top:5px; left:10px; border-radius:50%;">  
                          {{ Auth::user()->UserName }}
                        </a>
  
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/dashboard"><i class="glyphicon glyphicon-cloud"></i> Dashboard </a>
                            <a class="dropdown-item" href="{{ route('profil') }}"> <i class="glyphicon glyphicon-user"></i>
                              {{ __('Profil') }} </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"  
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"><i class="glyphicon glyphicon-remove"></i>
                                {{ __('Logout') }}
                            </a>
                           
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
  </nav>