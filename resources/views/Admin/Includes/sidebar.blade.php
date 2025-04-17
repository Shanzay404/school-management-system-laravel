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
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? "active" : "" }}">
                    <i class="bi bi-grid-fill  {{ request()->routeIs('dashboard') ? "text-light" : "" }}"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            {{-- <li class="sidebar-item ">
                <a href="{{ route('redirect') }}" class="sidebar-link {{ request()->routeIs('redirect') ? "active" : "" }}">
                    <i class="bi bi-house-fill{{ request()->routeIs('redirect') ? "text-light" : "" }}"></i>
                    <span>Home Page</span>
                </a>
            </li> --}}
            <li class="sidebar-item ">
                <a href="{{ route('roles_and_permissions') }}" class="sidebar-link {{ request()->routeIs('roles_and_permissions') ? "active" : "" }}">
                    <i class="bi bi-shield-lock-fill {{ request()->routeIs('roles_and_permissions') ? "text-light" : "" }}"></i>
                    <span>Roles & Permissions</span>
                </a>
            </li>
            
            
            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('admin.users.data', 'admin.user.add','admin.user.edit', 'admin.user.view') ? "active" : "" }}">
                    <i class="bi bi-people-fill {{ request()->routeIs('admin.users.data', 'admin.user.add','admin.user.edit', 'admin.user.view') ? "text-light" : "" }} "></i>
                    <span>Users</span>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.users.data', 'admin.user.add','admin.user.edit', 'admin.user.view') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.users.data') }}" class="{{ request()->routeIs('admin.users.data') ? "active fw-bold" : "" }}">View</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.user.add') }}" class="{{ request()->routeIs('admin.user.add') ? "active fw-bold" : "" }}">Add</a>
                    </li>
                </ul>
            </li>
                


            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('admin.classes.view', 'admin.class.add','admin.class.edit') ? "active" : "" }}">
                    <i class="bi bi-clipboard-check {{ request()->routeIs('admin.classes.view', 'admin.class.add','admin.class.edit') ? "text-white" : "" }}"></i>
                    <span>Classes</span>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.classes.view', 'admin.class.add','admin.class.edit') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.classes.view') }}" class="{{ request()->routeIs('admin.classes.view') ? "active fw-bold" : "" }}">View</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.class.add') }}" class="{{ request()->routeIs('admin.class.add') ? "active fw-bold" : "" }}">Add</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('admin.sections.view', 'admin.section.add','admin.section.edit') ? "active" : "" }}">
                    <i class="bi bi-columns {{  request()->routeIs('admin.sections.view', 'admin.section.add','admin.section.edit') ? "text-white" : "" }}"></i>
                    <span>Sections</span>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.sections.view', 'admin.section.add','admin.section.edit') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.sections.view') }}" class="{{ request()->routeIs('admin.sections.view') ? "active fw-bold" : "" }}">View</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.section.add') }}" class="{{ request()->routeIs('admin.section.add') ? "active fw-bold" : "" }}">Add</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('subject.add','subjects.view','subject.detail','class_subject.assign') ? "active" : "" }}">
                    <i class="bi bi-book-fill {{ request()->routeIs('subject.add','subjects.view','subject.detail','class_subject.assign') ? "text-white" : "" }}"></i>
                    <span>Subjects</span>
                </a>
                <ul class="submenu {{ request()->routeIs('subject.add','subjects.view','subject.detail','subject.edit','class_subject.assign') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('subjects.view') }}" class="{{ request()->routeIs('subjects.view','subject.detail','subject.edit') ? "active fw-bold" : "" }}">View</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('subject.add') }}" class="{{ request()->routeIs('subject.add') ? "active fw-bold" : "" }}">Add</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('class_subject.assign') }}" class="{{ request()->routeIs('class_subject.assign') ? "active fw-bold" : "" }}">Assign Subjects</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('admin.student.attendance') ? "active" : "" }}">
                    <i class="bi bi-calendar-check {{ request()->routeIs('admin.student.attendance') ? "text-white" : "" }}"></i>
                    <span>Attendance</span>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.student.attendance','admin.student.mark-attendance') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.student.attendance') }}" class="{{ request()->routeIs('admin.student.attendance','admin.student.mark-attendance') ? "active fw-bold" : "" }}">Subjects</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('admin.students.data', 'admin.student.add','admin.student.edit', 'admin.student.view','admin.student.generateReport') ? "active" : "" }}">
                    <i class="bi bi-person-lines-fill {{ request()->routeIs('admin.students.data', 'admin.student.add','admin.student.edit', 'admin.student.view','admin.student.generateReport') ? "text-white" : "" }}"></i>
                    <span>Students</span>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.students.data', 'admin.student.add','admin.student.edit', 'admin.student.view','admin.student.generateReport') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.students.data') }}" class="{{ request()->routeIs('admin.students.data') ? "active fw-bold" : "" }}">View</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.student.add') }}" class="{{ request()->routeIs('admin.student.add') ? "active fw-bold" : "" }}">Add</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class="sidebar-link {{ request()->routeIs('admin.fee.add','admin.fee.edit', 'admin.fee.view') ? "active" : "" }}">
                    <i class="bi bi-table {{ request()->routeIs('admin.fee.add','admin.fee.edit', 'admin.fee.view') ? "text-white" : "" }}"></i>
                    <span>Fee Structure</span>
                </a>
                <ul class="submenu {{ request()->routeIs('admin.fee.add','admin.fee.edit', 'admin.fee.view') ? "d-block" : "" }}">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.fee.view') }}" class="{{ request()->routeIs('admin.fee.view') ? "active fw-bold" : "" }}">View</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.fee.add') }}" class="{{ request()->routeIs('admin.fee.add') ? "active fw-bold" : "" }}">Add</a>
                    </li>
                </ul>
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
            <li class="sidebar-item ">
                <a href="{{ route('admin.staff.view') }}" class="sidebar-link {{ request()->routeIs('admin.staff.view') ? "active" : "" }}">
                    <i class="bi bi-person-fill {{ request()->routeIs('admin.staff.view') ? "text-light" : "" }}"></i>
                    <span>Staff Management</span>
                </a>
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