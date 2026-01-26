<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('funnel_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funnel_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('email');
            $table->string('phone');

            // For yes_no store: "yes"/"no"
            // For text store the input string
            $table->string('question_answer')->nullable();

            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->index(['funnel_id', 'created_at']);
            $table->index(['email']);
            $table->index(['phone']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('funnel_submissions');
    }
};
