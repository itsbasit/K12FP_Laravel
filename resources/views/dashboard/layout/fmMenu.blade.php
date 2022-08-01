<div class="sidebar-body">
    <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item nav-category">Tutorials</li>
        <li class="nav-item">
            <a href="{{route('videos')}}" class="nav-link">
                <i class="link-icon" data-feather="video"></i>
                <span class="link-title">Demo VIdeos</span>
            </a>
        </li>

        <li class="nav-item nav-category">Schools Data</li>
        <li class="nav-item">
            <a href="{{url('fm/fund_raisers')}}" class="nav-link">
                <i class="link-icon" data-feather="calendar"></i>
                <span class="link-title">Fundraisers</span>
            </a>
        </li>

        <li class="nav-item nav-category">Students</li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#students" role="button" aria-expanded=""
                aria-controls="email">
                <i class="link-icon" data-feather="user"></i>
                <span class="link-title">Students</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="students">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="{{url('fm/students')}}" class="nav-link {{ request()->is('fm/students') ? 'active' : '' }}">High Students</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('fm/elementary_students')}}" class="nav-link">Elementary Students</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item {{ request()->is('fm/fundraisers-pages') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#pages" role="button" aria-expanded=""
                aria-controls="email">
                <i class="link-icon" data-feather="file-text"></i>
                <span class="link-title">Fundraiser Pages</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse {{ request()->is('fm/fundraisers-pages') ? 'show' : '' }}" id="pages">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="{{url('fm/pages')}}" class="nav-link">All Pages</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('fm/main/create')}}" class="nav-link">Create Main Page</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{url('fm/student/create')}}" class="nav-link">Create Student Page</a>
                    </li>

                </ul>
            </div>
        </li>

        
        <li class="nav-item nav-category">Invitations</li>
        <li class="nav-item">
            <a href="{{url('fm/invites')}}" class="nav-link">
                <i class="link-icon" data-feather="calendar"></i>
                <span class="link-title">Send Invites</span>
            </a>
        </li>

        <li class="nav-item nav-category">Payments</li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#payment" role="button" aria-expanded=""
                aria-controls="email">
                <i class="link-icon" data-feather="file-text"></i>
                <span class="link-title">Payment Requests</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="payment">
                <ul class="nav sub-menu">
                    <li class="nav-item">
                        <a href="#" class="nav-link">All Requests</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Request a Payment</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Info</li>
        <li class="nav-item">
            <a href="/" target="_blank" class="nav-link">
                <i class="link-icon" data-feather="hash"></i>
                <span class="link-title">Support</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/" target="_blank" class="nav-link">
                <i class="link-icon" data-feather="hash"></i>
                <span class="link-title">Visit Site</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="/" target="_blank" class="nav-link">
                <i class="link-icon" data-feather="log-out"></i>
                <span class="link-title">Logout</span>
            </a>
        </li>
    </ul>
</div>