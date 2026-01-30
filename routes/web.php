<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TrackVisitor;

// Full Setup Route - Create tables directly without migration
Route::get('/setup-database', function () {
    $output = '<h2>Database Setup</h2>';
    
    try {
        // Create tables if not exist
        if (!Schema::hasTable('portfolios')) {
            Schema::create('portfolios', function ($table) {
                $table->id();
                $table->text('image');
                $table->text('description');
                $table->timestamps();
            });
            $output .= '<p>✅ Created table: portfolios</p>';
        } else {
            $output .= '<p>ℹ️ Table portfolios already exists</p>';
        }

        if (!Schema::hasTable('pesan')) {
            Schema::create('pesan', function ($table) {
                $table->id();
                $table->string('nama');
                $table->string('email');
                $table->string('paket')->nullable();
                $table->text('pesan');
                $table->boolean('is_read')->default(false);
                $table->timestamps();
            });
            $output .= '<p>✅ Created table: pesan</p>';
        } else {
            $output .= '<p>ℹ️ Table pesan already exists</p>';
        }

        if (!Schema::hasTable('services')) {
            Schema::create('services', function ($table) {
                $table->id();
                $table->string('nama');
                $table->string('icon')->default('bi-camera');
                $table->text('deskripsi');
                $table->decimal('harga', 12, 0)->default(0);
                $table->string('satuan')->nullable();
                $table->enum('tipe', ['layanan', 'paket'])->default('layanan');
                $table->boolean('is_featured')->default(false);
                $table->integer('urutan')->default(0);
                $table->timestamps();
            });
            $output .= '<p>✅ Created table: services</p>';
        } else {
            $output .= '<p>ℹ️ Table services already exists</p>';
        }

        if (!Schema::hasTable('visitors')) {
            Schema::create('visitors', function ($table) {
                $table->id();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->string('page_visited')->nullable();
                $table->text('referrer')->nullable();
                $table->string('country')->nullable();
                $table->string('city')->nullable();
                $table->string('device')->nullable();
                $table->string('browser')->nullable();
                $table->timestamp('visited_at')->nullable();
                $table->timestamps();
            });
            $output .= '<p>✅ Created table: visitors</p>';
        } else {
            $output .= '<p>ℹ️ Table visitors already exists</p>';
        }
        
        // Check all tables
        $output .= '<h3>Tables Status:</h3>';
        $tables = ['users', 'portfolios', 'services', 'pesan', 'visitors'];
        foreach ($tables as $table) {
            $exists = Schema::hasTable($table);
            $status = $exists ? '✅ EXISTS' : '❌ NOT FOUND';
            $output .= "<p>Table <strong>$table</strong>: $status</p>";
        }
        
        $output .= '<br><a href="/create-admin">Create Admin User</a> | <a href="/">Go to Home</a>';
        
    } catch (\Exception $e) {
        $output .= '<p style="color:red;">Error: ' . $e->getMessage() . '</p>';
    }
    
    return $output;
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

// Test login route
Route::get('/test-login', function () {
    try {
        $user = User::where('email', 'admin@studio.com')->first();
        if (!$user) {
            return 'User not found! <a href="/create-admin">Create Admin</a>';
        }
        
        $output = '<h3>Test Login Debug:</h3>';
        $output .= '<p>User found: ' . $user->email . '</p>';
        $output .= '<p>Password hash: ' . substr($user->password, 0, 20) . '...</p>';
        
        // Test password
        $testPassword = 'admin123';
        $isValid = Hash::check($testPassword, $user->password);
        $output .= '<p>Password "admin123" valid: ' . ($isValid ? 'YES ✓' : 'NO ✗') . '</p>';
        
        if ($isValid) {
            // Try manual login
            \Illuminate\Support\Facades\Auth::login($user);
            if (\Illuminate\Support\Facades\Auth::check()) {
                $output .= '<p style="color:green;">Login successful! <a href="/admin/portfolios">Go to Admin</a></p>';
            } else {
                $output .= '<p style="color:red;">Auth::login failed</p>';
            }
        }
        
        return $output;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Debug portfolio images
Route::get('/check-portfolios', function () {
    try {
        $portfolios = \App\Models\Portfolio::all();
        $output = '<h3>Portfolios in Database:</h3>';
        if ($portfolios->isEmpty()) {
            $output .= '<p>No portfolios found.</p>';
        } else {
            foreach ($portfolios as $p) {
                $output .= '<div style="margin-bottom:20px; padding:10px; border:1px solid #ccc;">';
                $output .= '<p><strong>ID:</strong> ' . $p->id . '</p>';
                $output .= '<p><strong>Description:</strong> ' . $p->description . '</p>';
                $output .= '<p><strong>Image URL:</strong> <code>' . htmlspecialchars($p->image) . '</code></p>';
                $output .= '<p><strong>Preview:</strong></p>';
                $output .= '<img src="' . $p->image . '" style="max-width:300px; border:1px solid #ddd;" onerror="this.style.border=\'3px solid red\'; this.alt=\'GAGAL LOAD - URL tidak valid\';">';
                $output .= '</div>';
            }
        }
        return $output;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Public Routes - with visitor tracking
Route::middleware([TrackVisitor::class])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
    Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
    Route::get('/portofolio', [PageController::class, 'portofolio'])->name('portofolio');
    Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
    Route::get('/promo', [PageController::class, 'promo'])->name('promo');
    Route::post('/kontak', [PageController::class, 'kontakStore'])->name('kontak.store');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes - Protected by Auth Middleware
Route::prefix('admin')->middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

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
