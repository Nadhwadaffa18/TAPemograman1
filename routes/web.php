<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthController;

// Setup Route - Run migrations (visit once to setup database)
Route::get('/setup-database', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return 'Database migrated successfully!<br><pre>' . Artisan::output() . '</pre><br><a href="/create-admin">Next: Create Admin User</a>';
    } catch (\Exception $e) {
        return 'Migration error: ' . $e->getMessage();
    }
});

// Create Admin User Route
Route::get('/create-admin', function () {
    try {
        // Delete existing admin first, then create new
        User::where('email', 'admin@studio.com')->delete();
        
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@studio.com',
            'password' => Hash::make('admin123'),
        ]);
        
        return 'Admin user created successfully!<br><br>
                <strong>ID:</strong> ' . $admin->id . '<br>
                <strong>Email:</strong> admin@studio.com<br>
                <strong>Password:</strong> admin123<br><br>
                <a href="/login">Go to Login</a>';
    } catch (\Exception $e) {
        return 'Error creating admin: ' . $e->getMessage();
    }
});

// Check users in database
Route::get('/check-users', function () {
    try {
        $users = User::all();
        $output = '<h3>Users in Database:</h3>';
        if ($users->isEmpty()) {
            $output .= '<p>No users found. <a href="/create-admin">Create Admin</a></p>';
        } else {
            foreach ($users as $user) {
                $output .= '<p>ID: ' . $user->id . ' | Name: ' . $user->name . ' | Email: ' . $user->email . '</p>';
            }
        }
        $output .= '<br><a href="/create-admin">Recreate Admin</a> | <a href="/login">Login</a>';
        return $output;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage() . '<br><a href="/setup-database">Run Setup Database</a>';
    }
});

// Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
Route::get('/portofolio', [PageController::class, 'portofolio'])->name('portofolio');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PageController::class, 'kontakStore'])->name('kontak.store');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes - Protected by Auth Middleware
Route::prefix('admin')->middleware('auth')->group(function () {
    
    // Portfolio
    Route::name('portfolios.')->group(function () {
        Route::get('portfolios', [PortfolioController::class, 'index'])->name('index');
        Route::get('portfolios/create', [PortfolioController::class, 'create'])->name('create');
        Route::post('portfolios', [PortfolioController::class, 'store'])->name('store');
        Route::get('portfolios/{portfolio}', [PortfolioController::class, 'show'])->name('show');
        Route::get('portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('edit');
        Route::put('portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('update');
        Route::delete('portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('destroy');
    });

    // Pesan
    Route::name('pesan.')->group(function () {
        Route::get('pesan', [PesanController::class, 'index'])->name('index');
        Route::get('pesan/{pesan}', [PesanController::class, 'show'])->name('show');
        Route::delete('pesan/{pesan}', [PesanController::class, 'destroy'])->name('destroy');
    });

    // Services
    Route::name('services.')->group(function () {
        Route::get('services', [ServiceController::class, 'index'])->name('index');
        Route::get('services/create', [ServiceController::class, 'create'])->name('create');
        Route::post('services', [ServiceController::class, 'store'])->name('store');
        Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('services/{service}', [ServiceController::class, 'update'])->name('update');
        Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('destroy');
    });
});
