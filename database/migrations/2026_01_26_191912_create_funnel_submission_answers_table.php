<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('funnel_submission_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funnel_submission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('funnel_question_id')->constrained()->cascadeOnDelete();

            // store string for radio/text, JSON array for checkbox
            $table->text('answer_text')->nullable();
            $table->json('answer_json')->nullable();

            $table->timestamps();

            $table->unique(['funnel_submission_id', 'funnel_question_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('funnel_submission_answers');
    }
};

