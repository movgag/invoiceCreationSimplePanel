<header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>T</b>T</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Test</b>Task</span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-fixed-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle waves-effect" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav" data-dropdown-in="flipInY" data-dropdown-out="fadeOut">
                <li>
                    <a class="nav-link toggle-fullscreen" href="#">
                        <i class="fa fa-arrows-alt"></i>
                    </a>
                </li>

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle waves-effect" data-toggle="dropdown">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                        <!-- The user image in the navbar-->
                        <img src="{{asset('backend')}}/img/avatars/avatar2.png" class="user-image" alt="User Image">
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-search-overlap" id="site_navbar_search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <div class="input-group">
                            <input type="text" id="overlay_search" name="overlay-search" class="form-control" placeholder="Search">
                            <span class="input-group-addon">
                                <a  href="javascript:void(0)" class="close-input-overlay waves-effect" data-target="#site_navbar_search" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="fa fa-times"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </nav>
</header>