@extends('layouts.app')

@section('content')
    <main class="offset-md-3 offset-lg-2 col-12 ms-sm-auto px-md-4 py-4" style="height:100vh; overflow-y:auto;">
        <div class="container">
            <h3 class="fw-normal mb-4" style="color:#3b82f6;">Order Details - #{{ $order->id }}</h3>

            <div class="card shadow-sm border-0 mb-4 rounded-4">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6"><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</div>
                        <div class="col-md-6">
                            <strong>State:</strong>
                            @php
                                $state = strtolower($order->state);
                                $badgeClass = match($state) {
                                    'ready' => 'success',
                                    'canceled' => 'warning',
                                    'placed' => 'secondary',
                                    'failed' => 'danger',
                                    'designed' => 'info',
                                    default => 'secondary',
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($order->state) }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6"><strong>Representer Name:</strong> {{ $order->representer_name }}</div>
                        <div class="col-md-6"><strong>Mobile:</strong> {{ $order->representer_mobile }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6"><strong>Company Address:</strong> {{ $order->company_address }}</div>
                        <div class="col-md-6"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Total Price:</strong> Rs. {{ number_format($order->total_price, 2) }}</div>
                        <div class="col-md-4"><strong>Paid:</strong> Rs. {{ number_format($order->amount_paid, 2) }}</div>
                        <div class="col-md-4"><strong>Due:</strong> Rs. {{ number_format($order->amount_due, 2) }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6"><strong>Designer:</strong> {{ $order->designer->name ?? 'N/A' }}</div>
                        <div class="col-md-6"><strong>Printer:</strong> {{ $order->printer->name ?? 'N/A' }}</div>
                    </div>

                    <div class="mb-3">
                        <strong>Remarks:</strong>
                        <p class="text-muted">{{ $order->remarks }}</p>
                    </div>
                </div>
            </div>

            <h5 class="mb-3">Ordered Items</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                    <tr>
                        <th>Item</th>
                        <th>Model</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item['item'] ?? 'N/A' }}</td>
                            <td>{{ $item['model'] ?? 'N/A' }}</td>
                            <td>{{ $item['qty'] ?? 'N/A' }}</td>
                            <td>Rs. {{ number_format($item['unit_price'] ?? 0, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No items found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('order.view') }}" class="btn btn-secondary mt-3">← Back to Order List</a>
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
@endsection
