@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Admin Dashboard</h2>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h2>{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Service Providers</h5>
                    <h2>{{ $totalProviders }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Total Bookings</h5>
                    <h2>{{ $totalBookings }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Pending Approvals</h5>
                    <h2>{{ $pendingProviders }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabs for different sections -->
    <ul class="nav nav-tabs mb-3" id="adminTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#pendingProviders">Pending Providers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#allProviders">All Providers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#categories">Categories</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#allBookings">All Bookings</a>
        </li>
    </ul>
    
    <div class="tab-content">
        <!-- Pending Providers Tab -->
        <div class="tab-pane fade show active" id="pendingProviders">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Pending Provider Approvals</h5>
                </div>
                <div class="card-body">
                    @forelse($pendingProviderList as $provider)
                    <div class="border-bottom mb-3 pb-3">
                        <div class="row">
                            <div class="col-md-8">
                                <h6>{{ $provider->business_name }}</h6>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-user"></i> {{ $provider->user->name }}<br>
                                    <i class="fas fa-envelope"></i> {{ $provider->user->email }}<br>
                                    <i class="fas fa-tag"></i> {{ $provider->category->name }}<br>
                                    <i class="fas fa-map-marker-alt"></i> {{ $provider->city }}, {{ $provider->area }}<br>
                                    <i class="fas fa-phone"></i> {{ $provider->phone }}
                                </p>
                            </div>
                            <div class="col-md-4 text-end">
                                <form action="{{ route('admin.providers.approve', $provider) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.providers.reject', $provider) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Reject this provider?')">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center">No pending approvals</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- All Providers Tab -->
        <div class="tab-pane fade" id="allProviders">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">All Service Providers</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Business Name</th>
                                    <th>Owner</th>
                                    <th>Category</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Approved</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allProviders as $provider)
                                <tr>
                                    <td>{{ $provider->id }}</td>
                                    <td>{{ $provider->business_name }}</td>
                                    <td>{{ $provider->user->name }}</td>
                                    <td>{{ $provider->category->name }}</td>
                                    <td>{{ $provider->city }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $provider->status }}">
                                            {{ ucfirst(str_replace('_', ' ', $provider->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($provider->is_approved)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewProvider{{ $provider->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProvider{{ $provider->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('admin.providers.delete', $provider) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this provider permanently?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        
                                        <!-- View Modal -->
                                        <div class="modal fade" id="viewProvider{{ $provider->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $provider->business_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Owner:</strong> {{ $provider->user->name }}</p>
                                                        <p><strong>Email:</strong> {{ $provider->user->email }}</p>
                                                        <p><strong>Phone:</strong> {{ $provider->phone }}</p>
                                                        <p><strong>Category:</strong> {{ $provider->category->name }}</p>
                                                        <p><strong>Address:</strong> {{ $provider->address }}</p>
                                                        <p><strong>City:</strong> {{ $provider->city }}</p>
                                                        <p><strong>Area:</strong> {{ $provider->area }}</p>
                                                        <p><strong>Pincode:</strong> {{ $provider->pincode }}</p>
                                                        <p><strong>Experience:</strong> {{ $provider->experience ?? 'N/A' }}</p>
                                                        <p><strong>Base Price:</strong> ₹{{ number_format($provider->base_price ?? 0) }}</p>
                                                        <p><strong>Rating:</strong> {{ number_format($provider->rating, 1) }} ⭐</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editProvider{{ $provider->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.providers.update', $provider) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit {{ $provider->business_name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>Business Name</label>
                                                                <input type="text" name="business_name" class="form-control" value="{{ $provider->business_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Phone</label>
                                                                <input type="text" name="phone" class="form-control" value="{{ $provider->phone }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>City</label>
                                                                <input type="text" name="city" class="form-control" value="{{ $provider->city }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Area</label>
                                                                <input type="text" name="area" class="form-control" value="{{ $provider->area }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Base Price</label>
                                                                <input type="number" step="0.01" name="base_price" class="form-control" value="{{ $provider->base_price }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="available" {{ $provider->status == 'available' ? 'selected' : '' }}>Available</option>
                                                                    <option value="working" {{ $provider->status == 'working' ? 'selected' : '' }}>Working</option>
                                                                    <option value="free" {{ $provider->status == 'free' ? 'selected' : '' }}>Free</option>
                                                                    <option value="on_leave" {{ $provider->status == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $allProviders->links() }}
                </div>
            </div>
        </div>
        
        <!-- Categories Tab -->
        <div class="tab-pane fade" id="categories">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Manage Categories</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="icon" class="form-control" placeholder="Icon (e.g., fa-bolt)">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success w-100">Add Category</button>
                            </div>
                        </div>
                    </form>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td><i class="fas {{ $category->icon }}"></i></td>
                                <td>
                                    <span class="badge bg-{{ $category->is_active ? 'success' : 'danger' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editCategory{{ $category->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.categories.delete', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            
                            <!-- Edit Category Modal -->
                            <div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Icon</label>
                                                    <input type="text" name="icon" class="form-control" value="{{ $category->icon }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Status</label>
                                                    <select name="is_active" class="form-control">
                                                        <option value="1" {{ $category->is_active ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ !$category->is_active ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- All Bookings Tab -->
        <div class="tab-pane fade" id="allBookings">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">All Bookings</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Booking #</th>
                                    <th>Customer</th>
                                    <th>Provider</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allBookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->booking_number }}</td>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->serviceProvider->business_name }}</td>
                                    <td>{{ $booking->category->name }}</td>
                                    <td>{{ date('d M Y', strtotime($booking->service_date)) }}</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $booking->status == 'pending' ? 'warning' : 
                                            ($booking->status == 'accepted' ? 'success' : 
                                            ($booking->status == 'completed' ? 'info' : 'danger')) 
                                        }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>₹{{ number_format($booking->total_amount ?? 0) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $allBookings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .status-badge {
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }
    .btn-group .btn {
        margin: 0 2px;
    }
</style>
@endsection