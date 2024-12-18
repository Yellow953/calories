<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" class="form-control input" name="q" id="searchInput" placeholder="Type to search..."
                        autocomplete="off" autofocus>
                </div>

                <div id="searchResults" class="list-group"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header px-4 border-bottom-0">
                <h5 class="modal-title fw-bold text-secondary" id="profileModalLabel">Preferences</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <!-- Language Selection -->
                <div class="mb-4">
                    <label for="languageSelect" class="form-label fw-medium text-muted">Language</label>
                    <select id="languageSelect" class="form-select px-3 py-2 rounded-3 bg-secondary">
                        <option value="en" selected>English</option>
                        <option value="ar">Arabic</option>
                        <option value="fr">French</option>
                        <option value="de">German</option>
                    </select>
                </div>
                <!-- Currency Selection -->
                <div class="mb-4">
                    <label for="currencySelect" class="form-label fw-medium text-muted">Currency</label>
                    <select id="currencySelect" class="form-select px-3 py-2 rounded-3 bg-secondary">
                        <option class="bg-light" value="usd" selected>USD - US Dollar</option>
                        <option class="bg-light" value="eur">EUR - Euro</option>
                        <option class="bg-light" value="sar">SAR - Saudi Riyal</option>
                        <option class="bg-light" value="aed">AED - UAE Dirham</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer px-4 border-top-0 justify-content-between">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="button" id="savePreferences" class="btn btn-primary rounded-pill px-4 py-2">
                    Save Preferences
                </button>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-2" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-secondary fw-bold" id="offcanvasCartLabel">Your Cart</h5>
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
                <span class="text-secondary">Total Items:</span>
                <span id="cart-total-items">3</span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="text-secondary">Total Price:</span>
                <span id="cart-total-price">$50.00</span>
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary w-100">Proceed to Checkout</button>
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