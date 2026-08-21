<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{__('landing.calories')}}</title>

    {{-- SEO --}}
    @php
        $defaultDescription = 'Calories by Fatima — healthy food store in Saida, Lebanon. Shop organic products, dried & freeze-dried fruits, sugar-free snacks, protein snacks, sweeteners, honey and weight-loss supplements. Delivery across Lebanon.';
        $metaDescription = trim(html_entity_decode($__env->yieldContent('meta_description', $defaultDescription), ENT_QUOTES));
        $ogImage = trim($__env->yieldContent('meta_image', asset('assets/images/hero.png')));
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords"
        content="Calories, Calories by Fatima, healthy food Lebanon, organic products Saida, dried fruits, freeze dried fruits, sugar free snacks, protein snacks, sweeteners, honey, weight loss supplements">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Calories by Fatima">
    <meta name="theme-color" content="#0a5f33">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Calories by Fatima">
    <meta property="og:title" content="@yield('title') - {{__('landing.calories')}}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="{{ str_replace('-', '_', app()->getLocale()) }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title') - {{__('landing.calories')}}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">

    {{-- Preconnects --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- JQuery -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">

    {{-- Structured data: local business (SEO / GEO) --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Store',
        'name' => 'Calories by Fatima',
        'description' => $defaultDescription,
        'image' => asset('assets/images/logo.png'),
        'url' => url('/'),
        'telephone' => ['+96170833158', '+96176629552'],
        'email' => 'fatimakhansa97@gmail.com',
        'currenciesAccepted' => 'USD, LBP',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Natasha Saeed Street',
            'addressLocality' => 'Saida',
            'addressCountry' => 'LB',
        ],
        'areaServed' => 'Lebanon',
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens' => '08:00',
            'closes' => '20:00',
        ],
        'sameAs' => [
            'https://www.instagram.com/calories_by_fatima',
            'https://www.tiktok.com/@caloriesbyfatima',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @stack('structured_data')
</head>

<body class="custom_scroller">
    @include('layouts._announcement')
    @include('layouts._header')

    <div class="mt-5 mt-md-2">
        @yield('content')
    </div>

    @include('layouts._footer')
    @include('layouts._sponsor')

    @include('layouts._modals')

    <div id="whatsapp">
        <a href="https://web.whatsapp.com/send?autoload=1&app_absent=0&phone=96170833158" target="_blank">
            <img src="{{ asset('assets/images/whatsapp.png') }}" alt="whatsapp logo" class="img-fluid">
        </a>
    </div>

    <script defer src="{{asset('assets/js/custom/bootstrap-carousel.js')}}"></script>
    <script defer src="{{ asset('assets/js/frontend.js') }}"></script>
</body>

</html>