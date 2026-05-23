<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ServiceProviderMiddleware;

// ==================== PUBLIC ROUTES ====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Service Provider Registration Routes (Public)
Route::get('/provider/register', [ServiceProviderController::class, 'showRegistrationForm'])->name('provider.register');
Route::post('/provider/register', [ServiceProviderController::class, 'register'])->name('provider.register.submit');
Route::get('/provider/registered', [ServiceProviderController::class, 'registered'])->name('provider.registered');
Route::get('/provider/pending', [ServiceProviderController::class, 'pending'])->name('provider.pending');

// Test Routes (Remove after testing)
Route::get('/test-provider-form', function () {
    $categories = App\Models\ServiceCategory::all();
    return view('provider.test-register', compact('categories'));
});

Route::post('/test-provider-submit', function (Illuminate\Http\Request $request) {
    \Log::info('Test registration received', $request->all());

    try {
        $user = App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'service_provider',
        ]);

        $provider = App\Models\ServiceProvider::create([
            'user_id' => $user->id,
            'service_category_id' => $request->service_category_id,
            'business_name' => $request->business_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'area' => $request->area,
            'pincode' => $request->pincode,
            'description' => $request->description,
            'experience' => $request->experience,
            'base_price' => $request->base_price,
            'is_approved' => false,
            'status' => 'available',
        ]);

        return "Success! User ID: {$user->id}, Provider ID: {$provider->id}";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// ==================== AUTHENTICATED ROUTES ====================
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // ROLE-BASED DASHBOARD REDIRECT - FIXED
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->role === 'service_provider') {
            $provider = $user->serviceProvider;
            if ($provider && $provider->is_approved) {
                return redirect()->route('provider.dashboard');
            }
            return redirect()->route('provider.pending')
                ->with('error', 'Your account is pending admin approval.');
        }
        
        // Regular user dashboard
        return app(App\Http\Controllers\DashboardController::class)->index();
    })->name('dashboard');

    // Booking Routes (for users)
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/create/{provider}', [BookingController::class, 'create'])->name('create');
        Route::post('/store/{provider}', [BookingController::class, 'store'])->name('store');
        Route::get('/{booking}', [BookingController::class, 'show'])->name('show');
        Route::post('/{booking}/cancel', [BookingController::class, 'cancel'])->name('cancel');
    });

    // Review Routes
    Route::post('/reviews/{booking}', [ReviewController::class, 'store'])->name('reviews.store');
});

// ==================== SERVICE PROVIDER ROUTES ====================
Route::middleware(['auth:sanctum', 'verified', ServiceProviderMiddleware::class])
    ->prefix('provider')
    ->name('provider.')
    ->group(function () {
        Route::get('/dashboard', [ServiceProviderController::class, 'dashboard'])->name('dashboard');
        Route::get('/bookings', [ServiceProviderController::class, 'bookings'])->name('bookings');
        Route::post('/bookings/{booking}/accept', [BookingController::class, 'accept'])->name('accept');
        Route::post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('reject');
        Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('complete');
        Route::get('/profile', [ServiceProviderController::class, 'profile'])->name('profile');
        Route::put('/profile', [ServiceProviderController::class, 'updateProfile'])->name('profile.update');
        Route::post('/status', [ServiceProviderController::class, 'updateStatus'])->name('status.update');
    });

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth:sanctum', 'verified', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/providers', [AdminController::class, 'providers'])->name('providers');
        Route::post('/providers/{provider}/approve', [AdminController::class, 'approveProvider'])->name('providers.approve');
        Route::post('/providers/{provider}/reject', [AdminController::class, 'rejectProvider'])->name('providers.reject');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::put('/providers/{provider}/update', [AdminController::class, 'updateProvider'])->name('providers.update');
        Route::delete('/providers/{provider}/delete', [AdminController::class, 'deleteProvider'])->name('providers.delete');
        Route::put('/categories/{category}/update', [AdminController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{category}/delete', [AdminController::class, 'deleteCategory'])->name('categories.delete');
    });