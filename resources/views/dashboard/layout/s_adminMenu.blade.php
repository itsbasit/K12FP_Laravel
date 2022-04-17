<div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="{{ url('/dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Schools Data</li>
      <li class="nav-item {{ request()->is('admin/states','admin/counties','admin/districts','admin/schools') ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#email" role="button" aria-expanded="" aria-controls="email">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Schools Data</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ request()->is('admin/states','admin/counties','admin/districts','admin/schools') ? 'show' : '' }}" id="email">
          <ul class="nav sub-menu ">
            <li class="nav-item">
              <a href="{{url('admin/states')}}" class="nav-link {{ request()->is('admin/states','admin/states/*') ? 'active' : '' }}">States</a>
            </li>

            <li class="nav-item">
              <a href="{{url('admin/counties')}}" class="nav-link {{ request()->is('admin/counties','admin/counties/*') ? 'active' : '' }}">Counties</a>
            </li>

            <li class="nav-item">
              <a href="{{url('admin/districts')}}" class="nav-link {{ request()->is('admin/districts','admin/districts/*') ? 'active' : '' }}">Districts</a>
            </li>

            <li class="nav-item">
              <a href="{{url('admin/schools')}}" class="nav-link {{ request()->is('admin/schools','admin/schools/*') ? 'active' : '' }}">Schools</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ request()->is('admin/videos','admin/videos/*') ? 'active' : '' }}">
        <a href="{{url('admin/videos')}}" class="nav-link {{ request()->is('admin/videos','admin/videos/*') ? 'active' : '' }}">
          <i class="link-icon" data-feather="message-square"></i>
          <span class="link-title">Demo VIdeos</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Fundraisers</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Payment Requests</span>
        </a>
      </li>

      
      <li class="nav-item nav-category">Users</li>
      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Users</span>
        </a>
      </li>

      <li class="nav-item nav-category">Site</li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#pages" role="button" aria-expanded="" aria-controls="email">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Pages</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="pages">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="#" class="nav-link">All</a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">Add New</a>
            </li> 
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Site Setting</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Stripe Setting</span>
        </a>
      </li>
 
      <li class="nav-item nav-category">Docs</li>
      <li class="nav-item">
        <a href="/" target="_blank" class="nav-link">
          <i class="link-icon" data-feather="hash"></i>
          <span class="link-title">Visit Site</span>
        </a>
      </li>
    </ul>
  </div>