<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/">Cars Rent</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link {{ $active === 'home' ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                <a class="nav-link {{ $active === 'cars' ? 'active' : '' }}" href="/cars">List Mobil</a>
            </div>
            {{-- <div class="navbar-nav ms-auto">
          @auth
              <div class="">
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" href="#"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
              </div>
          @else   
          <a class="nav-link {{ $active === "login" ? 'active' : '' }}" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a> 
          @endauth
        </div> --}}
            <div class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Welcome, {{ auth()->user()->username }}
                        </a>
                        @if (Auth::user()->role_id == 1)
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/dashboard"><i
                                            class="bi bi-layout-text-sidebar-reverse"></i>
                                        My Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item" href="#"><i
                                                class="bi bi-box-arrow-right"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/profile"><i
                                            class="bi bi-layout-text-sidebar-reverse"></i>
                                        My Account</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item" href="#"><i
                                                class="bi bi-box-arrow-right"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        @endif
                    </li>
                @else
                    <a class="nav-link {{ $active === 'login' ? 'active' : '' }}" href="/login"><i
                            class="bi bi-box-arrow-in-right"></i> Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
