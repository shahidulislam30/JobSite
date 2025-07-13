<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">JobSite</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{$routeName == 'home' ? 'active' :''}}">
                <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">

            @auth()

                   @if(auth()->user()->user_type == 1)
                    <li class="nav-item">
                        <a class="nav-link {{$routeName == 'dashboard' ? 'active' :''}}" href="{{route('dashboard')}}">
                            {{ucwords(auth()->user()->business_name).' Dashboard'}}
                        </a>
                    </li>
                       @else
                    <li class="nav-item">
                        <a class="nav-link {{$routeName == 'profile' ? 'active' :''}}" href="{{route('profile')}}">
                            {{ucwords(auth()->user()->first_name).' Profile'}}
                        </a>
                    </li>
                    @endif
                       <li class="nav-item">
                           <a class="nav-link" href="{{route('logout')}}">
                               Logout
                           </a>
                       </li>
                @endauth

            @guest
            <li class="nav-item {{$routeName == 'login.view' ? 'active' :''}}">
                <a class="nav-link" href="{{route('login.view')}}">Login</a>
            </li>
            <li class="nav-item {{$routeName == 'register.view' ? 'active' :''}}">
                <a class="nav-link" href="{{route('register.view')}}">Registration</a>
            </li>
                @endguest

        </ul>
    </div>
</nav>
