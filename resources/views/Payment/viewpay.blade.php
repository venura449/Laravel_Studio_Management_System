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
        <h3 class="fw-normal pb-3" style=" color: #3b82f6;">Billing & Payment - Cafe Pixel</h3>
        <!-- Filter and Search Controls -->
        <div class="row mb-3">
            <div class="col-md-4 mb-2">
                <input type="text" id="orderSearch" class="form-control" placeholder="Search by Name, Phone, Item...">
            </div>
            @if(auth()->user()->getrole()=="admin"|| auth()->user()->getrole()=="cashier")
                <div class="col-md-3 mb-2">
                    <select id="statusFilter" class="form-select" >
                        <option value="">All Statuses</option>
                        <option value="Placed">Placed</option>
                        <option value="Designed">Designed</option>
                        <option value="Ready">Ready</option>
                        <option value="Canceled">Canceled</option>
                        <option value="Failed">Failed</option>
                    </select>
                </div>
            @endif


        </div>
        <div class="card shadow-lg border-0 rounded-4 my-4 w-100">
            <div class="card-body p-4">
                <div class="table-responsive-sm">

                    <table class="table table-bordered table-hover table-striped align-middle text-center">
                        <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Created</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders as $o)
                            @php
                                $items = json_decode($o->items, true);
                                $firstItem = $items[0] ?? null;
                                $jsonOrder = json_encode([
                                    'id' => $o->id,
                                    'created_at' => $o->created_at->format('Y-m-d H:i'),
                                    'representer_name' => $o->representer_name,
                                    'representer_mobile' => $o->representer_mobile,
                                    'company_address' => $o->company_address,
                                    'items' => $items,
                                    'payment_method' => $o->payment_method,
                                    'state' => $o->state,
                                    'amount_paid' => $o->amount_paid,
                                    'amount_due' => $o->amount_due,
                                    'total_price' => $o->total_price,
                                    'designer' => optional($o->designer)->name,
                                    'printer' => optional($o->printer)->name,
                                    'remarks' => $o->remarks,
                                ]);
                            @endphp
                            <tr class="order-row"
                                data-name="{{ strtolower($o->representer_name ?? '') }}"
                                data-phone="{{ strtolower($o->representer_mobile ?? '') }}"
                                data-item="{{ strtolower($firstItem['item'] ?? '') }}"
                                data-status="{{ strtolower($o->state) }}"
                            >
                                <td>{{ $o->id }}</td>
                                <td>{{ $o->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $o->representer_name ?? 'N/A' }}</td>
                                <td>{{ $o->representer_mobile ?? 'N/A' }}</td>
                                <td>{{ $firstItem['item'] ?? 'N/A' }}</td>
                                <td>{{ $firstItem['qty'] ?? 'N/A' }}</td>
                                <td>Rs. {{ number_format($firstItem['unit_price'] ?? 0, 2) }}</td>
                                <td>{{ ucfirst($o->payment_method) ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $state = strtolower($o->state);
                                        $badgeClass = match($state) {
                                            'ready' => 'success',
                                            'canceled' => 'warning',
                                            'placed' => 'secondary',
                                            'failed' => 'danger',
                                            'designed' => 'info',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($o->state) }}</span>
                                </td>
                                    <td>
                                        <a href="{{route('order.printbill',$o->id)}}" class="view-order-btn text-primary me-2" title="Print Bill" target="_blank">
                                            <i class="bi bi-printer" aria-label="Print Bill"></i>
                                        </a>
                                        <a href="{{route('pay.paynow',$o->id)}}" class="view-order-btn text-success me-2" title="Pay Now">
                                            <i class="bi bi-credit-card" aria-label="Pay Now"></i>
                                        </a>
                                        <a href="{{route('pay.paylater',$o->id)}}" class="view-order-btn text-info me-2" title="Add to Bill">
                                            <i class="bi bi-plus-circle" aria-label="Add to Bill"></i>
                                        </a>
                                    </td>
                            </tr>
                        @empty
                            <tr><td colspan="10">No orders found</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
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

        .table-dark th, .table-dark td {
            border-color: #2d3748;
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
        document.addEventListener('DOMContentLoaded', function() {
            // --- Filter & Search Functionality ---
            const searchInput = document.getElementById('orderSearch');
            const statusFilter = document.getElementById('statusFilter');
            const rows = document.querySelectorAll('.order-row');

            function filterRows() {
                const search = searchInput.value.trim().toLowerCase();
                const status = statusFilter.value.trim().toLowerCase();
                rows.forEach(row => {
                    const name = row.getAttribute('data-name');
                    const phone = row.getAttribute('data-phone');
                    const item = row.getAttribute('data-item');
                    const rowStatus = row.getAttribute('data-status');
                    // Search matches any of name, phone, item
                    const matchesSearch = !search || name.includes(search) || phone.includes(search) || item.includes(search);
                    // Status filter
                    const matchesStatus = !status || rowStatus === status.toLowerCase();
                    row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
                });
            }
            searchInput.addEventListener('input', filterRows);
            statusFilter.addEventListener('change', filterRows);
        });
    </script>


@endsection




