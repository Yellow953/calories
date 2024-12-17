<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{Route('home')}}">
            <img
                src="{{ asset('assets/images/logo.png') }}"
                alt="Calories Logo"
                class="logo" />
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto center-menu">
                <li class="nav-item">
                    <a class="nav-link {{Route::is('home') ? 'active': ''}}" href="{{Route('home')}}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('about') ? 'active': ''}}" href="{{Route('about')}}">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('shop') ? 'active': ''}}" href="{{Route('shop')}}">SHOP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('contact') ? 'active': ''}}" href="{{Route('contact')}}">CONTACT</a>
                </li>
            </ul>
            @auth()
            <ul class="navbar-nav ms-auto">
                <li>
                    <form action="{{Route('logout')}}" method="POST">
                        @csrf
                        <button class="btn btn-primary nav-link ms-3 px-3 py-3" title="Logout" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                </li>
            </ul>
            @endauth
            @guest
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn-primary {{Route::is('login') ? 'active': ''}}" href="{{route('login')}}">LOGIN</a>
                </li>
            </ul>
            @endguest
        </div>
    </div>
</nav>