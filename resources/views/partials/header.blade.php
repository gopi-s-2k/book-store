<nav class="navbar navbar-dark bg-dark shadow-sm py-2">
    <div class="container d-flex align-items-center flex-wrap gap-2">
        <a class="navbar-brand fw-bold m-0" href="{{ route('home') }}">
            {{ config('app.name') }}
        </a>

        <ul class="navbar-nav admin-nav flex-row ms-md-2 gap-2">
            @guest('admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active text-white' : 'text-white-50' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
            @endguest


            @auth('admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active text-white' : 'text-white-50' }}"
                        href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.book.*') ? 'active text-white' : 'text-white-50' }}"
                        href="{{ route('admin.books') }}">Books</a>
                </li>
            @endauth
        </ul>

        <div class="ms-auto d-flex align-items-center gap-2">
            @guest('admin')
                <a href="{{ route('admin.login') }}" class="btn btn-sm btn-outline-light">Admin Login</a>
            @endguest

            @auth('admin')
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="me-2" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                        <span class="d-none d-sm-inline">{{ Auth::guard('admin')->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>
