@extends('layouts.app')

@section('title', ucwords($product->name))

@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($product->description ?: $product->name . ' — available at Calories by Fatima, healthy food store in Saida, Lebanon.'), 155))

@section('meta_image', asset($product->image))

@push('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->name,
    'image' => asset($product->image),
    'description' => \Illuminate\Support\Str::limit(strip_tags($product->description ?: $product->name), 300),
    'category' => optional($product->category)->name,
    'brand' => ['@type' => 'Brand', 'name' => 'Calories by Fatima'],
    'offers' => [
        '@type' => 'Offer',
        'price' => number_format($product->price * $currency->rate, 2, '.', ''),
        'priceCurrency' => strtoupper($currency->name ?? 'USD'),
        'availability' => 'https://schema.org/InStock',
        'url' => url()->current(),
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<section class="pb-5">
    <div class="container pb-5">
        <div class="row">
            <div class="col-md-6 mt-5">
                <div class="card mb-3 position-relative overflow-hidden">
                    <!-- Main Image -->
                    <img class="card-img img-fluid" src="{{ asset($product->image) }}" fetchpriority="high"
                        decoding="async" alt="{{ $product->name }}" id="product-detail">
                </div>

                <!-- Secondary Images Carousel -->
                @if ($product->secondary_images)
                <div class="row">
                    <div id="multi-item-example" class="col-12 carousel slide carousel-multi-item pointer-event"
                        data-bs-ride="carousel">
                        <div class="carousel-inner product-links-wap" role="listbox">
                            <div class="carousel-item active">
                                <div class="row">
                                    @foreach ($product->secondary_images as $image)
                                    <div class="col-4 p-2">
                                        <a href="#" class="secondary-image" data-image="{{ asset($image->path) }}">
                                            <img class="card-img secondary-img border img-fluid"
                                                src="{{ asset($image->path) }}" loading="lazy" decoding="async"
                                                alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- col end -->
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2 text-primary">{{ gtrans($product->name) }}</h1>
                        <div class="my-3">
                            <div class="d-flex justify-content-between my-2">
                                <span class="fw-bold">{{__('landing.category')}}:</span> {{ gtrans($product->category->name) }}
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-content-center">
                            <div class="fw-bold">{{__('landing.price')}}</div>
                            <div><span class="fw-bold text-success">{{ $currency->code }}{{
                                    number_format($product->price * $currency->rate) }}</span>
                                <span class="fs-7 text-muted text-decoration-line-through">{{ $currency->code
                                    }}{{number_format($product->compare_price * $currency->rate)
                                    }}</span>
                            </div>
                        </div>

                        <div class="mt-3 w-100">
                            <input type="number" min="0" step="1" value="1" name="quantity" id="quantity"
                                class="form-control my-2" required>
                            <a href="#" id="addToCart" class="btn btn-primary w-100 my-2 shake">
                                {{__('landing.addtocart')}} <i class="fa-solid fa-cart-shopping ms-1"></i>
                            </a>
                            <a href="#" id="buyNow" class="btn btn-cta my-2 shake">
                                {{__('landing.buynow')}} <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button text-primary fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                    aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                    {{__('landing.description')}}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    {{ gtrans($product->description) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 pt-4">
            <h2 class="section-heading mb-4">{{__('landing.similar_products')}}</h2>

            @foreach ($products as $pr)
            <div class="col-6 col-md-3 mb-3">
                <a href="{{ route('product', $pr->name) }}" class="text-decoration-none">
                    <div class="category-item h-100">
                        <div class="category-image">
                            <img src="{{ asset($pr->image) }}" class="img-fluid category-img" loading="lazy"
                                decoding="async" alt="{{ $pr->name }}">
                        </div>
                        <h5 class="category-title">{{ gtrans($pr->name) }}</h5>
                    </div>
                </a>
            </div>
            @endforeach

            {{-- <div class="row mt-5">
                <h2 class="my-4 text-center text-primary">{{__('landing.faq')}}</h2>

                <div class="accordion" id="accordionPanelsStayOpenExample1">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne1" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseOne1">
                                How do I determine my ring size when shopping online?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne1" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                To find your ring size, you can use a printable ring size chart available on most
                                jewelry
                                websites. Alternatively, you can visit a local jeweler to have your finger measured
                                professionally.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo2" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTwo2">
                                Are the gemstones in the jewelry natural or lab-created?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo2" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                Many jewelry pieces offer both natural and lab-created gemstone options. Check the
                                product
                                description or inquire with the seller to know the origin of the gemstones.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree3" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree3">
                                How should I care for my jewelry to maintain its shine and durability?
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree3" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                Proper care varies depending on the type of jewelry and materials used. Generally, it's
                                recommended to store jewelry in a dry, clean place, away from moisture and chemicals.
                                Regular cleaning with a soft cloth and mild soap solution can help maintain its shine.
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const product = {
            id: "{{ $product->id }}",
            name: "{{ $product->name }}",
            image: "{{ asset($product->image) }}",
            price: "{{ $product->price }}",
        };

        const addToCartBtn = document.getElementById('addToCart');
        const buyNowBtn = document.getElementById('buyNow');
        const quantityInput = document.getElementById('quantity');

        function getCart() {
            const cart = document.cookie
                .split('; ')
                .find(row => row.startsWith('cart='))
                ?.split('=')[1];
            return cart ? JSON.parse(decodeURIComponent(cart)) : [];
        }

        function saveCart(cart) {
            document.cookie = `cart=${encodeURIComponent(JSON.stringify(cart))}; path=/; max-age=${30 * 24 * 60 * 60}`;
        }

        addToCartBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const quantity = parseInt(quantityInput.value) || 1;

            let cart = getCart();

            const existingProduct = cart.find(item => item.id === product.id);
            if (existingProduct) {
                existingProduct.quantity += quantity;
            } else {
                cart.push({ ...product, quantity });
            }

            saveCart(cart);
            alert('Product added to cart!');
        });

        buyNowBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const quantity = parseInt(quantityInput.value) || 1;

            let cart = getCart();

            const existingProduct = cart.find(item => item.id === product.id);
            if (existingProduct) {
                existingProduct.quantity += quantity;
            } else {
                cart.push({ ...product, quantity });
            }

            saveCart(cart);

            window.location.href = "{{ route('checkout') }}";
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const secondaryImages = document.querySelectorAll('.secondary-image');
        const mainImage = document.getElementById('product-detail');

        secondaryImages.forEach(image => {
            image.addEventListener('click', function(event) {
                event.preventDefault();
                const newImageSrc = this.getAttribute('data-image');
                mainImage.setAttribute('src', newImageSrc);
            });
        });
    });
</script>
@endsection
