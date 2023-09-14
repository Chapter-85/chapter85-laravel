<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('bic-logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('bic-logo.png') }}" alt="" height="40">
            </span>
        </a>

        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('bic-logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('bic-logo.png') }}" alt="" height="40">
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link 
                    {{ Request::is('customers') ? 'active' : '' }}"
                        href="{{ route('customers.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Customers</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link 
                    {{ Request::is('agents') ? 'active' : '' }}"
                        href="{{ route('agents.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Agents</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link 
                    {{ Request::is('categories') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}" role="
                        button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link 
                    {{ Request::is('products') ? 'active' : '' }}"
                        href="{{ route('products.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Products</span>
                    </a>
                </li>

                {{-- @permission('show-branches')
                    <li class="nav-item">
                        <a class="nav-link menu-link  @if (Request::is('branch/*') || Request::is('branch/edit/*') || Request::is('employee/*')) active @endif" href="#branchModule"
                            data-bs-toggle="collapse" role="button"
                            aria-expanded="@if (Request::is('branch/*') || Request::is('branch/edit/*') || Request::is('employee/*')) true @else false @endif"
                            aria-controls="sidebarDashboards">
                            <i class="ri-stackshare-line"></i> <span
                                data-key="t-dashboards">{{ auth()->user()->hasRole('super_admin')? 'Branches': 'Branch' }}</span>
                        </a>
                        <div class="collapse menu-dropdown @if (Request::is('branch/*') || Request::is('branch/edit/*') || Request::is('employee/*')) show @endif" id="branchModule">
                            <ul class="nav nav-sm flex-column">
                                @if (auth()->user()->hasRole('super_admin'))
                                    <li class="nav-item ">
                                        <a href="{{ route('branches.index') }}"
                                            class="nav-link @if (Request::is('branch/*')) active @endif"
                                            data-key="t-analytics"> Branch List
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('branch.edit', auth()->user()->employee->branch->id) }}"
                                            class="nav-link @if (Request::is('branch/edit/*')) active @endif"
                                            data-key="t-analytics"> Branch
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="{{ route('employees.index') }}"
                                        class="nav-link @if (Request::is('employee/*')) active @endif"
                                        data-key="t-analytics">
                                        Employees</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endpermission

                @permission('show-leads')
                    <li class="nav-item">
                        <a class="nav-link menu-link @if (Request::is('lead/*') || Request::is('lead-type/*') || Request::is('lead-status/*')) active @endif" href="#leadModule"
                            data-bs-toggle="collapse" role="button"
                            aria-expanded="@if (Request::is('lead/*') || Request::is('lead-type/*') || Request::is('lead-status/*')) true @else false @endif"
                            aria-controls="sidebarDashboards">
                            <i class="ri-customer-service-2-line"></i> <span data-key="t-dashboards">Lead Management</span>
                        </a>
                        <div class="collapse menu-dropdown @if (Request::is('lead/*') || Request::is('lead-type/*') || Request::is('lead-status/*')) show @endif" id="leadModule">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('leads.index') }}"
                                        class="nav-link @if (Request::is('lead/*')) active @endif"
                                        data-key="t-analytics">
                                        Leads</a>
                                </li>

                                @permission('show-lead-type')
                                    <li class="nav-item">
                                        <a href="{{ route('lead-type.index') }}"
                                            class="nav-link @if (Request::is('lead-type/*')) active @endif"
                                            data-key="t-analytics"> Lead Types
                                        </a>
                                    </li>
                                @endpermission

                                @permission('show-lead-status')
                                    <li class="nav-item">
                                        <a href="{{ route('lead-status.index') }}"
                                            class="nav-link @if (Request::is('lead-status/*')) active @endif"
                                            data-key="t-analytics">
                                            Lead Statuses</a>
                                    </li>
                                @endpermission

                            </ul>
                        </div>
                    </li>
                @endpermission

                @if (auth()->user()->hasRole('super_admin'))
                    <li class="nav-item">
                        <a class="nav-link menu-link @if (Request::is('class/*') || Request::is('courses/*') || Request::is('source/*') || Request::is('activities/*') || Request::is('system-modules') || Request::is('user/*') || Request::is('roles') || Request::is('roles/*') || Request::is('permissions') || Request::is('country/*') || Request::is('state/*') || Request::is('city/*') || Request::is('contact-code/*')) active @endif"
                            href="#CourseModule" data-bs-toggle="collapse" role="button"
                            aria-expanded="@if (Request::is('class/*') || Request::is('courses/*') || Request::is('source/*') || Request::is('activities/*') || Request::is('system-modules') || Request::is('user/*') || Request::is('roles') || Request::is('roles/*') || Request::is('permissions') || Request::is('country/*') || Request::is('state/*') || Request::is('city/*') || Request::is('contact-code/*')) true @else false @endif"
                            aria-controls="sidebarDashboards">
                            <i class="ri-settings-line"></i> <span data-key="t-dashboards">System Settings</span>
                        </a>
                        <div class="collapse menu-dropdown @if (Request::is('class/*') || Request::is('courses/*') || Request::is('source/*') || Request::is('activities/*') || Request::is('system-modules') || Request::is('user/*') || Request::is('roles') || Request::is('roles/*') || Request::is('permissions') || Request::is('country/*') || Request::is('state/*') || Request::is('city/*') || Request::is('contact-code/*')) show @endif"
                            id="CourseModule">
                            <ul class="nav nav-sm flex-column">
                                @permission('show-roles-and-permissions')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link @if (Request::is('system-modules') || Request::is('user/*') || Request::is('roles') || Request::is('roles/*') || Request::is('permissions')) active @endif"
                                            href="#roleAndPermissions" data-bs-toggle="collapse" role="button"
                                            aria-expanded="@if (Request::is('system-modules') || Request::is('user/*') || Request::is('roles') || Request::is('roles/*') || Request::is('permissions')) true @else false @endif"
                                            aria-controls="sidebarDashboards">
                                            {{-- <i class="ri-eye-off-line"></i> --}}
                {{-- <span data-key="t-dashboards">Roles & Permissions</span>
                </a> --}}
                {{-- <div class="collapse menu-dropdown @if (Request::is('system-modules') || Request::is('user/*') || Request::is('roles') || Request::is('roles/*') || Request::is('permissions')) show @endif"
                                            id="roleAndPermissions">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{ route('system-modules.index') }}"
                                                        class="nav-link @if (Request::is('system-modules')) active @endif"
                                                        data-key="t-analytics"> System Modules
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('users.index') }}"
                                                        class="nav-link @if (Request::is('user/*')) active @endif"
                                                        data-key="t-analytics">
                                                        Users</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('roles.index') }}"
                                                        class="nav-link @if (Request::is('roles/*') || Request::is('roles')) active @endif"
                                                        data-key="t-analytics">
                                                        Roles
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('permissions.index') }}"
                                                        class="nav-link @if (Request::is('permissions')) active @endif"
                                                        data-key="t-analytics"> Permissions
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endpermission

                                @permission('show-region-management')
                                    <li class="nav-item">
                                        <a class="nav-link menu-link @if (Request::is('country/*') || Request::is('state/*') || Request::is('city/*') || Request::is('contact-code/*')) active @endif"
                                            href="#regionManagement" data-bs-toggle="collapse" role="button"
                                            aria-expanded="@if (Request::is('country/*') || Request::is('state/*') || Request::is('city/*') || Request::is('contact-code/*')) true @else false @endif"
                                            aria-controls="sidebarDashboards">
                                            {{-- <i class="ri-global-line"></i> --}}
                {{-- <span data-key="t-dashboards">Region Management</span>
                </a> --}}
                {{-- <div class="collapse menu-dropdown @if (Request::is('country/*') || Request::is('state/*') || Request::is('city/*') || Request::is('contact-code/*')) show @endif"
                                            id="regionManagement">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{ route('country.index') }}"
                                                        class="nav-link @if (Request::is('country/*')) active @endif"
                                                        data-key="t-analytics">
                                                        Country</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('state.index') }}"
                                                        class="nav-link @if (Request::is('state/*')) active @endif"
                                                        data-key="t-analytics">
                                                        State
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('city.index') }}"
                                                        class="nav-link @if (Request::is('city/*')) active @endif"
                                                        data-key="t-analytics">
                                                        City
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('contact-code.index') }}"
                                                        class="nav-link @if (Request::is('contact-code/*')) active @endif"
                                                        data-key="t-analytics">
                                                        Contact Code
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endpermission
                                <li class="nav-item">
                                    <a href="{{ route('class-grades.index') }}"
                                        class="nav-link @if (Request::is('class/*')) active @endif"
                                        data-key="t-analytics">
                                        Classes</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('course.index') }}"
                                        class="nav-link @if (Request::is('courses/*')) active @endif"
                                        data-key="t-analytics"> Courses
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sources.index') }}"
                                        class="nav-link @if (Request::is('source/*')) active @endif"
                                        data-key="t-analytics">
                                        Sources</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('activities.index') }}"
                                        class="nav-link @if (Request::is('activities/*')) active @endif"
                                        data-key="t-analytics">
                                        Activity&nbsp;Logs</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif --}}
            </ul>
        </div>
    </div>
</div>
