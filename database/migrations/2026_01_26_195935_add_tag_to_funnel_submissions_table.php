<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('funnel_submissions', function (Blueprint $table) {
            $table->string('tag')->nullable()->after('question_answer');
            $table->json('tag_meta')->nullable()->after('tag');
        });
    }

    public function down(): void {
        Schema::table('funnel_submissions', function (Blueprint $table) {
            $table->dropColumn(['tag', 'tag_meta']);
        });
    }
};
