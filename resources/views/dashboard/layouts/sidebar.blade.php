<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        @if (Auth::user()->role_id == 1)
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>ADMINISTRATOR</span>
            </h6>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                        href="/dashboard">
                        <span data-feather="home" class="align-text-bottom"></span>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/cars*') ? 'active' : '' }}" aria-current="page"
                        href="/dashboard/cars">
                        <span data-feather="list" class="align-text-bottom"></span>
                        Cars List
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}"
                        href="/dashboard/categories">
                        <span data-feather="grid" class="align-text-bottom"></span>
                        Car Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/users*') ? 'active' : '' }}" href="/dashboard/users">
                        <span data-feather="user-check" class="align-text-bottom"></span>
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/rent-logs*') ? 'active' : '' }}"
                        href="/dashboard/rent-logs">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        Riwayat Log Penyewaan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard/rent-return*') ? 'active' : '' }}"
                        href="/dashboard/rent-return">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        Pengembalian Mobil
                    </a>
                </li>
            </ul>
        @else
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="profile">
                        <span data-feather="file-text" class="align-text-bottom"></span>
                        Riwayat Sewa
                    </a>
                </li>
            </ul>
        @endif
    </div>
</nav>
