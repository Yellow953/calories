<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{Route('home')}}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Calories Logo" class="logo" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
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
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa fa-search"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                        <i class="fa-solid fa-user"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasCart" role="button"
                        aria-controls="offcanvasCart">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>