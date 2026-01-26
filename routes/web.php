<?php

use App\Http\Controllers\FunnelPublicController;
use App\Http\Controllers\Admin\FunnelController as AdminFunnelController;
use App\Http\Controllers\Admin\FunnelSubmissionController;
use App\Models\Funnel;

Route::get('/', function () {
    $funnels = Funnel::where('is_active', true)->orderBy('created_at', 'desc')->get();
    return view('home', compact('funnels'));
})->name('home');

Route::get('/f/{slug}', [FunnelPublicController::class, 'show'])->name('funnels.show');
Route::post('/f/{slug}', [FunnelPublicController::class, 'submit'])->name('funnels.submit');
Route::get('/f/{slug}/thanks', [FunnelPublicController::class, 'thanks'])->name('funnels.thanks');

// Admin (wrap with auth middleware in real app)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('funnels', \App\Http\Controllers\Admin\FunnelController::class);
    Route::get('submissions', [\App\Http\Controllers\Admin\FunnelSubmissionController::class, 'index'])
        ->name('submissions.index');
});


// <?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
