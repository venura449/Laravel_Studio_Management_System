@extends('layouts.app')

@section('content')
<div id="print-area" style="max-width: 800px; margin: 0 auto; background: #fff; padding: 24px;">
    <div class="d-flex flex-column align-items-center mb-4">
        <img src="{{ asset('logo.png') }}" alt="Cafe Pixel Logo" style="height:60px; margin-bottom:10px;">
        <div class="text-center mb-2">
            <h4 class="mb-1 fw-bold" style="color:#3b82f6;">Cafe Pixel Printing Solutions Private Limited</h4>
            <div>No 50, Hyde Park Corner, Colombo 02</div>
            <div>0112 680 061 &nbsp; | &nbsp; cafepixel.p@gmail.com</div>
        </div>
        <div class="w-100 d-flex justify-content-between align-items-center">
            <h2 class="fw-bold mb-0" style="color:#3b82f6;">Invoice</h2>
            <button class="btn btn-outline-primary d-print-none" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
        </div>
    </div>
    <div class="mb-3">
        <strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}<br>
        <strong>Order ID:</strong> #{{ $order->id }}<br>
        <strong>Customer:</strong> {{ $order->representer_name }}<br>
        <strong>Mobile:</strong> {{ $order->representer_mobile }}<br>
        <strong>Company:</strong> {{ $order->company_name }}<br>
        <strong>Address:</strong> {{ $order->company_address }}
    </div>
    <h5 class="mb-3">Items</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Model</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @php $grandTotal = 0; @endphp
        @foreach($items as $item)
            @php $lineTotal = ($item['qty'] ?? 0) * ($item['unit_price'] ?? 0); $grandTotal += $lineTotal; @endphp
            <tr>
                <td>{{ $item['item'] ?? 'N/A' }}</td>
                <td>{{ $item['model'] ?? 'N/A' }}</td>
                <td>{{ $item['qty'] ?? 0 }}</td>
                <td>Rs. {{ number_format($item['unit_price'] ?? 0, 2) }}</td>
                <td>Rs. {{ number_format($lineTotal, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div style="display: flex; justify-content: flex-end;">
        <table class="table table-borderless" style="max-width: 350px;">
            <tr>
                <th>Total Price:</th>
                <td>Rs. {{ number_format($order->total_price, 2) }}</td>
            </tr>
            <tr>
                <th>Discount:</th>
                <td>Rs. {{ number_format($order->discount, 2) }}</td>
            </tr>
            <tr>
                <th>Amount Paid:</th>
                <td>Rs. {{ number_format($order->amount_paid, 2) }}</td>
            </tr>
            <tr>
                <th>Amount Due:</th>
                <td>Rs. {{ number_format($order->amount_due, 2) }}</td>
            </tr>
        </table>
    </div>
    <div class="mt-4">
        <strong>Remarks:</strong>
        <p class="text-muted">{{ $order->remarks }}</p>
    </div>
</div>
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
    /* Print styles for A4 scaling */
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
            background: #fff !important;
        }
        #print-area {
            width: 190mm;
            min-height: 270mm;
            margin: 0 auto;
            background: #fff !important;
            box-shadow: none !important;
            padding: 0 !important;
        }
        .card, .card-body, .container, .row, .col-md-8 {
            box-shadow: none !important;
            background: #fff !important;
            margin: 0 !important;
            padding: 0 !important;
            border: none !important;
        }
        .d-print-none {
            display: none !important;
        }
        body * { visibility: hidden; }
        #print-area, #print-area * { visibility: visible; }
        #print-area { position: absolute; left: 0; top: 0; }
        @page {
            size: A4;
            margin: 10mm;
        }
    }
</style>
@endsection
