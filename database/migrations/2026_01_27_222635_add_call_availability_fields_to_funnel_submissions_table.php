<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('funnel_submissions', function (Blueprint $table) {
            $table->date('preferred_call_date_from')->nullable()->after('user_agent');
            $table->date('preferred_call_date_to')->nullable()->after('preferred_call_date_from');
            $table->text('call_availability_description')->nullable()->after('preferred_call_date_to');
        });
    }

    public function down(): void {
        Schema::table('funnel_submissions', function (Blueprint $table) {
            $table->dropColumn(['preferred_call_date_from', 'preferred_call_date_to', 'call_availability_description']);
        });
    }
};
