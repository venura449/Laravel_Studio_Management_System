@extends('layouts.app')

@section('content')
    <!-- Main Content Area -->
    <main class="offset-md-3 offset-lg-2 col-12 ms-sm-auto px-md-4 py-4" style="height:100vh; overflow-y:auto;">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h2 class="mb-4 text-center fw-bold text-primary">Add New Order</h2>
        <div class="card shadow-lg border-0 rounded-4 my-4 w-100">
            <div class="card-body p-4">
                <form action="{{route('order.add')}}" method="POST">
                    @csrf
                    <!-- Company Customer Section -->
                    <div class="mb-4 pb-3 border-bottom">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">For The Company Customer</h5>
                            <button type="button" class="btn btn-success btn-sm">for Normal Client</button>
                        </div>
                        <div class="row g-2 mt-2">
                            <div class="col-md-6">
                                <input type="text" name="company_name" placeholder="Company Name" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="company_address" placeholder="Company Address" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="company_mobile" placeholder="Company Mobile Number" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="representer_name" placeholder="Representer Name" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="representer_mobile" placeholder="Representer Mobile Number" class="form-control mb-2">
                            </div>
                        </div>
                    </div>
                    <!-- Designer & Printer -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h5 class="mb-3">Designer & Printer</h5>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <select name="designer_id" class="form-select mb-2">
                                    <option value="">Select Graphic Designer</option>
                                    <option value="1">Test</option>


                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="printer_id" class="form-select mb-2">
                                    <option value="">Select Printer</option>
                                    <option value="1">Test</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Services (Dynamic Entry) -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h5 class="mb-3">Add Services</h5>
                        <div class="row g-2 align-items-end" id="service-entry-row">
                            <div class="col-md-5">
                                <input type="text" id="serviceName" class="form-control" placeholder="Service Name" autocomplete="off">
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="serviceQty" class="form-control" placeholder="Quantity" min="1">
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="servicePrice" class="form-control" placeholder="Price" min="0">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary w-100" id="addServiceBtn">Add</button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <table class="table table-bordered table-sm align-middle text-center" id="servicesTable" style="display:none;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Service</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <input type="hidden" name="services" id="servicesInput">
                        </div>
                    </div>
                    <!-- Items (Dynamic Entry) -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h5 class="mb-3">Add Items</h5>
                        <div class="row g-2 align-items-end" id="item-entry-row">
                            <div class="col-md-3">
                                <input type="text" id="itemName" class="form-control" placeholder="Item Name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="itemModel" class="form-control" placeholder="Model">
                            </div>
                            <div class="col-md-2">
                                <input type="number" id="itemQty" class="form-control" placeholder="Quantity" min="1">
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="itemUnitPrice" class="form-control" placeholder="Unit Price" min="0">
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary w-100" id="addItemBtn">Add</button>
                            </div>
                        </div>
                        <div class="mt-3">
                            <table class="table table-bordered table-sm align-middle text-center" id="itemsTable" style="display:none;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Item</th>
                                        <th>Model</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <input type="hidden" name="items" id="itemsInput">
                        </div>
                    </div>
                    <!-- Payment Section -->
                    <div class="mb-4 pb-3 border-bottom">
                        <h5 class="mb-3">Payment Details</h5>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-select mb-2">
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="online">Online</option>
                                    <option value="check">Cheque</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="total_price" placeholder="Total Price" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="amount_paid" placeholder="Amount Paid" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="discount" placeholder="Discount" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="amount_due" placeholder="Amount Due" class="form-control mb-2">
                            </div>
                        </div>
                    </div>
                    <!-- Remarks -->
                    <div class="mb-4">
                        <h5 class="mb-3">Remarks</h5>
                        <textarea name="remarks" class="form-control" rows="4" placeholder="Special Remark..."></textarea>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill">Confirm Order</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <style>
        .sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .nav-link {
            color: rgba(255,255,255,0.7);
            padding: 0.75rem 1rem;
            border-radius: 5px;
            margin-bottom: 0.25rem;
            transition: all 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(59, 130, 246, 0.5);
        }
        .nav-link.active {
            font-weight: 500;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .dropdown-item {
            padding: 0.5rem 1rem;
        }
        .dropdown-item:hover {
            background-color: rgba(59, 130, 246, 0.3);
        }
        @media (max-width: 991.98px) {
            .sidebar {
                position: static !important;
                height: auto !important;
            }
            main[style] {
                margin-left: 0 !important;
            }
        }
    </style>
    <script>
        let services = [];
        const serviceName = document.getElementById('serviceName');
        const serviceQty = document.getElementById('serviceQty');
        const servicePrice = document.getElementById('servicePrice');
        const addServiceBtn = document.getElementById('addServiceBtn');
        const servicesTable = document.getElementById('servicesTable');
        const servicesTbody = servicesTable.querySelector('tbody');
        const servicesInput = document.getElementById('servicesInput');

        // --- Service Autocomplete Logic ---
        let allServices = [];
        let suggestionBox;
        function createSuggestionBox() {
            suggestionBox = document.createElement('div');
            suggestionBox.style.position = 'absolute';
            suggestionBox.style.zIndex = 1000;
            suggestionBox.className = 'list-group';
            suggestionBox.style.width = serviceName.offsetWidth + 'px';
            suggestionBox.style.maxHeight = '200px';
            suggestionBox.style.overflowY = 'auto';
            suggestionBox.style.background = '#fff';
            suggestionBox.style.border = '1px solid #ccc';
            suggestionBox.style.top = (serviceName.offsetTop + serviceName.offsetHeight) + 'px';
            suggestionBox.style.left = serviceName.offsetLeft + 'px';
            serviceName.parentNode.appendChild(suggestionBox);
        }
        function removeSuggestionBox() {
            if (suggestionBox) {
                suggestionBox.remove();
                suggestionBox = null;
            }
        }
        function showSuggestions(filtered) {
            removeSuggestionBox();
            if (!filtered.length) return;
            createSuggestionBox();
            filtered.forEach(service => {
                const item = document.createElement('button');
                item.type = 'button';
                item.className = 'list-group-item list-group-item-action';
                item.textContent = service.item;
                item.onclick = function() {
                    serviceName.value = service.item;
                    servicePrice.value = service.unit_price;
                    removeSuggestionBox();
                };
                suggestionBox.appendChild(item);
            });
        }
        serviceName.addEventListener('input', function() {
            const val = this.value.toLowerCase();
            if (!val) {
                removeSuggestionBox();
                return;
            }
            const filtered = allServices.filter(s => s.item.toLowerCase().includes(val));
            showSuggestions(filtered);
        });
        serviceName.addEventListener('focusout', function(e) {
            setTimeout(removeSuggestionBox, 200); // Delay to allow click
        });
        // Fetch all services on page load
        fetch('/item/json')
            .then(res => res.json())
            .then(data => {
                allServices = data;
            });
        // --- End Service Autocomplete Logic ---

        function renderServices() {
            servicesTbody.innerHTML = '';
            services.forEach((s, idx) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${s.service}</td>
                    <td>${s.qty}</td>
                    <td>${s.price}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeService(${idx})">Remove</button></td>
                `;
                servicesTbody.appendChild(row);
            });
            servicesTable.style.display = services.length ? '' : 'none';
            servicesInput.value = JSON.stringify(services);
        }
        addServiceBtn.onclick = function() {
            const name = serviceName.value.trim();
            const qty = parseInt(serviceQty.value);
            const price = parseFloat(servicePrice.value);
            if (!name || isNaN(qty) || qty < 1 || isNaN(price) || price < 0) {
                alert('Please enter valid service details.');
                return;
            }
            services.push({service: name, qty, price});
            serviceName.value = '';
            serviceQty.value = '';
            servicePrice.value = '';
            renderServices();
        };
        window.removeService = function(idx) {
            services.splice(idx, 1);
            renderServices();
        };

        let items = [];
        const itemName = document.getElementById('itemName');
        const itemModel = document.getElementById('itemModel');
        const itemQty = document.getElementById('itemQty');
        const itemUnitPrice = document.getElementById('itemUnitPrice');
        const addItemBtn = document.getElementById('addItemBtn');
        const itemsTable = document.getElementById('itemsTable');
        const itemsTbody = itemsTable.querySelector('tbody');
        const itemsInput = document.getElementById('itemsInput');

        function renderItems() {
            itemsTbody.innerHTML = '';
            items.forEach((i, idx) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${i.item}</td>
                    <td>${i.model}</td>
                    <td>${i.qty}</td>
                    <td>${i.unit_price}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${idx})">Remove</button></td>
                `;
                itemsTbody.appendChild(row);
            });
            itemsTable.style.display = items.length ? '' : 'none';
            itemsInput.value = JSON.stringify(items);
        }
        addItemBtn.onclick = function() {
            const name = itemName.value.trim();
            const model = itemModel.value.trim();
            const qty = parseInt(itemQty.value);
            const unit_price = parseFloat(itemUnitPrice.value);
            if (!name || !model || isNaN(qty) || qty < 1 || isNaN(unit_price) || unit_price < 0) {
                alert('Please enter valid item details.');
                return;
            }
            items.push({item: name, model, qty, unit_price});
            itemName.value = '';
            itemModel.value = '';
            itemQty.value = '';
            itemUnitPrice.value = '';
            renderItems();
        };
        window.removeItem = function(idx) {
            items.splice(idx, 1);
            renderItems();
        };
    </script>
@endsection
