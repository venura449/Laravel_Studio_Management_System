@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h3 class="text-primary mb-4">Add New Item</h3>

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

        <div class="card shadow-lg border-0 rounded-4 my-4 w-100">
            <div class="card-body p-4">
                <form action="{{route('item.store')}}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="item" class="form-label">Service Name</label>
                        <input type="text" name="item" class="form-control" id="item" value="{{ old('item') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="unit_price" class="form-label">Unit Price (Rs.)</label>
                        <input type="number" name="unit_price" class="form-control" id="unit_price" step="0.01" value="{{ old('unit_price') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Service</button>
                    <a href="" class="btn btn-secondary">Back to List</a>
                </form>
            </div>
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
    </style>
@endsection
