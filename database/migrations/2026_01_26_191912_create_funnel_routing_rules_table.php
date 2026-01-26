<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('funnel_routing_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funnel_id')->constrained()->cascadeOnDelete();

            $table->string('tag'); // e.g. IUL_Prospect
            $table->unsignedInteger('priority')->default(1); // higher wins

            // JSON conditions:
            // [
            //  {"question_key":"age_range","op":"in","value":["25–35","36–45"]},
            //  {"question_key":"goal","op":"in","value":["Grow tax-free","Leave a legacy"]}
            // ]
            $table->json('conditions');

            $table->text('thankyou_title')->nullable();
            $table->text('thankyou_body')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['funnel_id', 'priority']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('funnel_routing_rules');
    }
};
