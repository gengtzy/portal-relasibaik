<?php

use App\Livewire\Admin\PublicationManager;
use App\Livewire\Admin\MemberManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard to publications
Route::get('/dashboard', function () {
    return redirect()->route('admin.publications');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route khusus CRUD Admin Portal
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/publications', PublicationManager::class)->name('admin.publications');
    Route::get('/members', MemberManager::class)->name('admin.members');
});

// Tambahkan Route Logout Manual (karena Breeze Volt menggunakan Livewire action untuk logout)
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';

