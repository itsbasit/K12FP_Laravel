<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <form class="search-form">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            @if (\Auth::user()->hasRole('fm'))
            <h6>Fund Manager</h6>
        @elseif(\Auth::user()->hasRole('super_admin'))
        <h6>Super Admin</h6>
        @endif
          </div>
        </div>
        
      </div>
    </form>
    <ul class="navbar-nav">

      <li class="nav-item dropdown nav-messages">
        <div class="badge badge-primary">
          <h6>
            <strong>$123</strong>
          </h6>
        </div>
      
      </li>
      
      <li class="nav-item dropdown nav-profile">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="profile">
        </a>
        <div class="dropdown-menu" aria-labelledby="profileDropdown">
          <div class="dropdown-header d-flex flex-column align-items-center">
            <div class="figure mb-3">
              <img src="{{ url('https://via.placeholder.com/80x80') }}" alt="">
            </div>
            <div class="info text-center">
              <p class="name font-weight-bold mb-0">{{Auth::user()->name}}</p>
              <p class="email text-muted mb-3">{{Auth::user()->email}}</p>
            </div>
          </div>
          <div class="dropdown-body">
            <ul class="profile-nav p-0 pt-3">
              <li class="nav-item">
                @if(\Auth::user()->hasRole('super_admin'))
                <a href="{{ url('admin/profile') }}" class="nav-link">
                  <i data-feather="user"></i>
                  <span>Profile</span>
                </a>
                @elseif(\Auth::user()->hasRole('fm'))
                <a href="{{ url('fm/profile') }}" class="nav-link">
                  <i data-feather="user"></i>
                  <span>Profile</span>
                </a>

                @endif
              </li>
              
              <li class="nav-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="nav-link">
                  <i data-feather="log-out"></i>
                  <span>Log Out</span>
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
              </li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
  </div>
</nav>