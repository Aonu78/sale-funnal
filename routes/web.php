<?php

use App\Http\Controllers\FunnelPublicController;
use App\Http\Controllers\ProfileController;
use App\Models\Funnel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FunnelWizardController;

// Home
Route::get('/', function () {
    $funnels = Funnel::where('is_active', true)->orderBy('created_at', 'desc')->get();
    return view('home', compact('funnels'));
})->name('home');


Route::get('/f/{slug}', [FunnelWizardController::class, 'landing'])->name('funnels.landing');
Route::post('/f/{slug}/start', [FunnelWizardController::class, 'start'])->name('funnels.start');

Route::get('/f/{slug}/step/{step}', [FunnelWizardController::class, 'step'])->name('funnels.step');
Route::post('/f/{slug}/step/{step}', [FunnelWizardController::class, 'saveStep'])->name('funnels.step.save');

Route::get('/f/{slug}/thanks', [FunnelWizardController::class, 'thanks'])->name('funnels.thanks');

// Admin (auth + admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('funnels', \App\Http\Controllers\Admin\FunnelController::class);

    Route::get('submissions', [\App\Http\Controllers\Admin\FunnelSubmissionController::class, 'index'])
        ->name('submissions.index');

    Route::get('submissions/export', [\App\Http\Controllers\Admin\FunnelSubmissionController::class, 'export'])
        ->name('submissions.export');

    Route::get('submissions/{submission}', [\App\Http\Controllers\Admin\FunnelSubmissionController::class, 'show'])
        ->name('submissions.show');

    Route::delete('submissions/{submission}', [\App\Http\Controllers\Admin\FunnelSubmissionController::class, 'destroy'])
        ->name('submissions.destroy');

        // Admin Builder
    Route::get('funnels/{funnel}/questions', [\App\Http\Controllers\Admin\FunnelQuestionController::class, 'index'])
        ->name('funnels.questions.index');
    Route::get('funnels/{funnel}/questions/create', [\App\Http\Controllers\Admin\FunnelQuestionController::class, 'create'])
        ->name('funnels.questions.create');
    Route::post('funnels/{funnel}/questions', [\App\Http\Controllers\Admin\FunnelQuestionController::class, 'store'])
        ->name('funnels.questions.store');
    Route::get('funnels/{funnel}/questions/{question}/edit', [\App\Http\Controllers\Admin\FunnelQuestionController::class, 'edit'])
        ->name('funnels.questions.edit');
    Route::put('funnels/{funnel}/questions/{question}', [\App\Http\Controllers\Admin\FunnelQuestionController::class, 'update'])
        ->name('funnels.questions.update');
    Route::delete('funnels/{funnel}/questions/{question}', [\App\Http\Controllers\Admin\FunnelQuestionController::class, 'destroy'])
        ->name('funnels.questions.destroy');

    // Options for question
    Route::get('questions/{question}/options', [\App\Http\Controllers\Admin\FunnelQuestionOptionController::class, 'index'])
        ->name('questions.options.index');
    Route::post('questions/{question}/options', [\App\Http\Controllers\Admin\FunnelQuestionOptionController::class, 'store'])
        ->name('questions.options.store');
    Route::put('questions/{question}/options/{option}', [\App\Http\Controllers\Admin\FunnelQuestionOptionController::class, 'update'])
        ->name('questions.options.update');
    Route::delete('questions/{question}/options/{option}', [\App\Http\Controllers\Admin\FunnelQuestionOptionController::class, 'destroy'])
        ->name('questions.options.destroy');

    // Routing rules
    Route::get('funnels/{funnel}/routing-rules', [\App\Http\Controllers\Admin\FunnelRoutingRuleController::class, 'index'])
        ->name('funnels.rules.index');
    Route::get('funnels/{funnel}/routing-rules/create', [\App\Http\Controllers\Admin\FunnelRoutingRuleController::class, 'create'])
        ->name('funnels.rules.create');
    Route::post('funnels/{funnel}/routing-rules', [\App\Http\Controllers\Admin\FunnelRoutingRuleController::class, 'store'])
        ->name('funnels.rules.store');
    Route::get('funnels/{funnel}/routing-rules/{rule}/edit', [\App\Http\Controllers\Admin\FunnelRoutingRuleController::class, 'edit'])
        ->name('funnels.rules.edit');
    Route::put('funnels/{funnel}/routing-rules/{rule}', [\App\Http\Controllers\Admin\FunnelRoutingRuleController::class, 'update'])
        ->name('funnels.rules.update');
    Route::delete('funnels/{funnel}/routing-rules/{rule}', [\App\Http\Controllers\Admin\FunnelRoutingRuleController::class, 'destroy'])
        ->name('funnels.rules.destroy');

});


Route::get('/admin', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
