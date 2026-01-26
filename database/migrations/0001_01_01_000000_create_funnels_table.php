<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('funnels', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            $table->string('title');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->string('hero_image_path')->nullable();

            $table->string('question_label')->nullable();
            $table->enum('question_type', ['yes_no', 'text'])->default('yes_no');

            $table->text('footer_text')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('funnels');
    }
};
