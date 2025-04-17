<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <h4 class="m-0" style="color: #06BBCC;"><i class="fa fa-book me-3"></i>eLEARNING</h4>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item ">
                <a href="{{ route('redirect') }}" class="sidebar-link {{ request()->routeIs('redirect') ? "active" : "" }}">
                    <i class="bi bi-house-fill {{ request()->routeIs('redirect') ? "text-light" : "" }}"></i>
                    <span>Home Page</span>
                </a>
            </li>
        
            <li class="sidebar-item ">
                <a href="{{ route('frontend.feeStructure') }}" class="sidebar-link {{ request()->routeIs('frontend.feeStructure') ? "active" : "" }}">
                    <i class="bi bi-table  {{ request()->routeIs('frontend.feeStructure') ? "text-light" : "" }}"></i>
                    <span>Fee Structure</span>
                </a>
            </li>
           
            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('feePayment.view','feePayment.form') ? "active" : "" }}">
                    <i class="bi bi-credit-card {{ request()->routeIs('feePayment.view','feePayment.form') ? "text-white" : "" }}"></i>
                    <span>Fee Payment</span>
                </a>
                <ul class="submenu {{ request()->routeIs('feePayment.form','feePayment.view') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('feePayment.view') }}" class="{{ request()->routeIs('feePayment.view') ? "active fw-bold" : "" }}">View</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('feePayment.form') }}" class="{{ request()->routeIs('feePayment.form') ? "active fw-bold" : "" }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('leave.add','leaves.view','leave.detail') ? "active" : "" }}">
                    <i class="bi bi-calendar-x {{ request()->routeIs('leave.add','leaves.view','leave.detail') ? "text-white" : "" }}"></i>
                    <span>Leaves</span>
                </a>
                <ul class="submenu {{ request()->routeIs('leave.add','leaves.view','leave.detail') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('leaves.view') }}" class="{{ request()->routeIs('leaves.view','leave.detail') ? "active fw-bold" : "" }}">View</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('leave.add') }}" class="{{ request()->routeIs('leave.add') ? "active fw-bold" : "" }}">Add</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('profile.edit','profile.view') ? "active" : "" }}">
                    <i class="bi bi-person-fill {{ request()->routeIs('profile.edit','profile.view') ? "text-white" : "" }}"></i>
                    <span>My Profile</span>
                </a>
                <ul class="submenu {{ request()->routeIs('profile.edit','profile.view') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('profile.view', encrypt(Auth::user()->id)) }}" class="{{ request()->routeIs('profile.view') ? "active fw-bold" : "" }}">View</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{route('profile.edit', encrypt(Auth::user()->id)) }}" class="{{ request()->routeIs('profile.edit') ? "active fw-bold" : "" }}">Edit</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item ">
                <a href="{{ route('student.changePassword', encrypt(Auth::user()->id)) }}" class="sidebar-link {{ request()->routeIs('student.changePassword') ? "active" : "" }}">
                    <i class="bi bi-lock-fill {{ request()->routeIs('student.changePassword') ? "text-light" : "" }}"></i>
                    <span>Change Password</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a href="{{ route('logout') }}" class="sidebar-link {{ request()->routeIs('logout') ? "active" : "" }}">
                    <i class="bi bi-box-arrow-right {{ request()->routeIs('logout') ? "text-light" : "" }}"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>