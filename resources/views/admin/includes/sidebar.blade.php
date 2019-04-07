<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
        <div class="image waves-effect">
            <img src="{{asset('backend')}}/img/avatars/avatar2.png" class="img-circle img-responsive " alt="User Image">
        </div>
        <div class="text-center info">
            <strong>{{ auth()->user()->name }}</strong>
            <i>{{ auth()->user()->email }}</i>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <li class="header">Navigation</li>
        <li>
            <a href="{{ route('home') }}" class="waves-effect"><i class="fa fa-bar-chart"></i> <span>Dashboard</span></a>
        </li>
    </ul>
    <!-- /.sidebar-menu -->
</div>