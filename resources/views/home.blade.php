@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4 fw-bold" style="color:#3b82f6;">Cafe Pixel Dashboard</h2>
    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-2"><i class="bi bi-clipboard-data fs-2 text-primary"></i></div>
                    <h5 class="card-title">Total Orders</h5>
                    <h3 class="fw-bold">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-2"><i class="bi bi-cash-coin fs-2 text-success"></i></div>
                    <h5 class="card-title">Total Revenue</h5>
                    <h3 class="fw-bold">Rs. {{ number_format($totalRevenue,2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-2"><i class="bi bi-exclamation-circle fs-2 text-warning"></i></div>
                    <h5 class="card-title">Outstanding</h5>
                    <h3 class="fw-bold">Rs. {{ number_format($outstanding,2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="mb-2"><i class="bi bi-bar-chart-line fs-2 text-info"></i></div>
                    <h5 class="card-title">Active Users</h5>
                    <h3 class="fw-bold">{{ $users->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Status Pie Chart & Recent Orders -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Order Status Distribution</h5>
                    <canvas id="statusChart" height="180"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card shadow border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Recent Orders</h5>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $o)
                                    @php $items = json_decode($o->items, true); $firstItem = $items[0] ?? null; @endphp
                                    <tr>
                                        <td>{{ $o->id }}</td>
                                        <td>{{ $o->created_at->format('Y-m-d H:i') }}</td>
                                        <td>{{ $o->representer_name ?? 'N/A' }}</td>
                                        <td>{{ $firstItem['item'] ?? 'N/A' }}</td>
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
                                        <td>Rs. {{ number_format($o->total_price,2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pie chart for order statuses
        var ctx = document.getElementById('statusChart').getContext('2d');
        var statusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($statusCounts)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($statusCounts)) !!},
                    backgroundColor: [
                        '#3b82f6', '#38bdf8', '#22d3ee', '#fbbf24', '#ef4444'
                    ],
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    });
</script>
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
