@extends('admin.layouts.app')

@section('title', 'Customers Management')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1">Customers</h3>
        <p class="text-muted mb-0">View all your registered and guest customers.</p>
    </div>
</div>

<div class="content-card">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Location</th>
                    <th>Customer Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="fw-bold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                        <td>{{ $user->city ?? 'N/A' }}, {{ $user->state ?? '' }}</td>
                        <td><span class="badge bg-primary">Registered</span></td>
                    </tr>
                @endforeach
                
                @foreach($guestCustomers as $guest)
                    <tr>
                        <td class="fw-bold">{{ $guest->customer_name }}</td>
                        <td>{{ $guest->email }}</td>
                        <td>{{ $guest->phone ?? 'N/A' }}</td>
                        <td>{{ $guest->city ?? 'N/A' }}, {{ $guest->state ?? '' }}</td>
                        <td><span class="badge bg-secondary">Guest (Order)</span></td>
                    </tr>
                @endforeach
                
                @if($users->isEmpty() && $guestCustomers->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-2 d-block mb-2"></i>
                            No customers found.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
