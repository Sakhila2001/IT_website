<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                            <i data-feather="align-justify"></i>
                        </a>
                    </li>
                    <a target="_blank" class="view-website-btn" href="/">
    <div class="view-btn-content d-flex align-items-center justify-content-center gap-3">

      <span class="view-text">View Website</span>
    </div>
  </a>
                </ul>
            </div>

            <!-- User Name Display -->
            <div class="d-none d-lg-block">{{ Auth::user()->name }}</div>

            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ asset('assets/dashboard/img/user1.png') }}"  style="width:40px;">

                        <!-- <span class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</span> -->
                    </a>

                    <div class="dropdown-menu dropdown-menu-right pullDown">
                            <!-- Profile Link -->
                            <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                                <i class="far fa-user mr-2"></i> Profile
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="#" class="dropdown-item has-icon text-danger" 
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </a>
                            </form>
                        </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
