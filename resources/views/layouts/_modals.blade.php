<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" class="form-control input" name="q" id="searchInput"
                        placeholder="{{__('landing.typetosearch')}}" autocomplete="off" autofocus>
                </div>

                <div id="searchResults" class="list-group"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <form action="{{ route('preferences') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header px-4 border-bottom-0">
                    <h5 class="modal-title fw-bold text-secondary" id="profileModalLabel">{{__('landing.preferences')}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <!-- Language Selection -->
                    <div class="mb-4">
                        <label for="languageSelect"
                            class="form-label fw-medium text-muted">{{__('landing.language')}}</label>
                        <select id="languageSelect" name="language"
                            class="form-select px-3 py-2 rounded-3 bg-secondary">
                            <option value="en" {{ request()->cookie('language', 'en') == 'en' ? 'selected' : ''
                                }}>{{__('landing.english')}}</option>
                            <option value="ar" {{ request()->cookie('language', 'en') == 'ar' ? 'selected' : ''
                                }}>{{__('landing.arabic')}}</option>
                        </select>
                    </div>
                    <!-- Currency Selection -->
                    <div class="mb-4">
                        <label for="currencySelect"
                            class="form-label fw-medium text-muted">{{__('landing.currency')}}</label>
                        <select id="currencySelect" name="currency"
                            class="form-select px-3 py-2 rounded-3 bg-secondary">
                            <option class="bg-light" value="usd" {{ request()->cookie('currency', 'usd') == 'usd' ?
                                'selected' : '' }}>{{__('landing.usd')}} - {{__('landing.usdollar')}}</option>
                            <option class="bg-light" value="lbp" {{ request()->cookie('currency', 'usd') == 'lbp' ?
                                'selected' : '' }}>{{__('landing.lbp')}} - {{__('landing.lebaneselira')}}</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer px-4 border-top-0 justify-content-between">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2"
                        data-bs-dismiss="modal">
                        {{__('landing.cancel')}}
                    </button>
                    <button type="submit" id="savePreferences" class="btn btn-primary rounded-pill px-4 py-2">
                        {{__('landing.save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-2" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-secondary fw-bold" id="offcanvasCartLabel">{{__('landing.yourcart')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="cart-items">
            <div class="cart-item d-flex align-items-center mb-3">
                <img src="https://via.placeholder.com/50" alt="Product Image" class="img-fluid rounded me-3">
                <div class="flex-grow-1">
                    <h6 class="mb-0">Product Name</h6>
                    <small class="text-muted">Price: $10.00 | Qty: 1</small>
                </div>
                <button class="btn btn-sm btn-danger">Remove</button>
            </div>
            <div class="cart-item d-flex align-items-center mb-3">
                <img src="https://via.placeholder.com/50" alt="Product Image" class="img-fluid rounded me-3">
                <div class="flex-grow-1">
                    <h6 class="mb-0">Another Product</h6>
                    <small class="text-muted">Price: $20.00 | Qty: 2</small>
                </div>
                <button class="btn btn-sm btn-danger">Remove</button>
            </div>
        </div>
        <hr>

        <div class="cart-summary">
            <div class="d-flex justify-content-between">
                <span class="text-secondary">{{__('landing.total_items')}}:</span>
                <span id="cart-total-items">3</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-secondary">{{__('landing.total_price')}}:</span>
                <span id="cart-total-price">$50.00</span>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('checkout') }}" class="btn btn-primary w-100">{{__('landing.proceed_to_checkout')}}</a>
        </div>
    </div>
</div>

<script>
    const searchInput = document.getElementById("searchInput");
    const resultsContainer = document.getElementById("searchResults");

    searchInput.addEventListener("input", function() {
        const query = searchInput.value.trim();

        if (query === "") {
            resultsContainer.innerHTML = "";
            return;
        }

        fetch(`{{route('products.search')}}?q=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                resultsContainer.innerHTML = "";

                if (data.length === 0) {
                    resultsContainer.innerHTML = `<div class="text-muted text-center">No products found.</div>`;
                    return;
                }

                data.forEach(product => {
                    const resultItem = `
                        <a href="${product.url}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <img src="${product.image || 'https://via.placeholder.com/50'}" alt="${product.name}" class="img-thumbnail me-3" style="width: 50px; height: 50px;">
                            <span>${product.name}</span>
                        </a>
                    `;
                    resultsContainer.innerHTML += resultItem;
                });
            })
            .catch(error => {
                console.error("Error fetching search results:", error);
            });
    });
</script>
