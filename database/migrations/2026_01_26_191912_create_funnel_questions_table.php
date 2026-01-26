<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('funnel_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funnel_id')->constrained()->cascadeOnDelete();

            $table->unsignedInteger('sort_order')->default(1);

            $table->string('key')->nullable(); // e.g. age_range, goal, concern
            $table->string('label');
            $table->text('help_text')->nullable();

            // radio = single select, checkbox = multi select, text = free text
            $table->enum('type', ['radio', 'checkbox', 'text'])->default('radio');

            $table->boolean('is_required')->default(true);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['funnel_id', 'sort_order']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('funnel_questions');
    }
};

