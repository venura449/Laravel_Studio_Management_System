@extends('layouts.app')

@section('content')
    <main class="offset-md-3 offset-lg-2 col-12 ms-sm-auto px-md-4 py-4" style="height:100vh; overflow-y:auto;">
        <div class="container">
            <h3 class="fw-normal mb-4" style="color:#3b82f6;">Edit Order - #{{ $order->id }}</h3>

            <form action="{{route('order.update',$order->id)}}" method="POST">
                @csrf

                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Representer Name</label>
                                <input type="text" name="representer_name" class="form-control" value="{{ old('representer_name', $order->representer_name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" name="representer_mobile" class="form-control" value="{{ old('representer_mobile', $order->representer_mobile) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Company Address</label>
                                <textarea name="company_address" class="form-control" rows="2" required>{{ old('company_address', $order->company_address) }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-select" required>
                                    @foreach(['cash', 'card', 'online', 'check'] as $method)
                                        <option value="{{ $method }}" {{ old('payment_method', $order->payment_method) == $method ? 'selected' : '' }}>
                                            {{ ucfirst($method) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">State</label>
                                <select name="state" class="form-select" required>
                                    @foreach(['placed', 'designed', 'ready', 'failed', 'canceled'] as $state)
                                        <option value="{{ $state }}" {{ old('state', $order->state) == $state ? 'selected' : '' }}>
                                            {{ ucfirst($state) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Total Price</label>
                                <input type="number" name="total_price" class="form-control" value="{{ old('total_price', $order->total_price) }}" step="0.01" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Amount Paid</label>
                                <input type="number" name="amount_paid" class="form-control" value="{{ old('amount_paid', $order->amount_paid) }}" step="0.01" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Amount Due</label>
                                <input type="number" name="amount_due" class="form-control" value="{{ old('amount_due', $order->amount_due) }}" step="0.01" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Designer</label>
                                <input type="text" class="form-control" value="{{ $order->designer->name ?? 'N/A' }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Printer</label>
                                <input type="text" class="form-control" value="{{ $order->printer->name ?? 'N/A' }}" disabled>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Remarks</label>
                            <textarea name="remarks" class="form-control" rows="3">{{ old('remarks', $order->remarks) }}</textarea>
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Order</button>
                <a href="" class="btn btn-secondary">Cancel</a>
            </form>
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
