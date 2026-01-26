<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('funnel_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funnel_question_id')->constrained()->cascadeOnDelete();

            $table->unsignedInteger('sort_order')->default(1);
            $table->string('label');
            $table->string('value')->nullable(); // optional normalized value
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['funnel_question_id', 'sort_order']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('funnel_question_options');
    }
};
