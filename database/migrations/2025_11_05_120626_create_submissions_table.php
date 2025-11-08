<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contributor_id')->nullable()->constrained('contributors')->onDelete('set null');
            $table->string('agency_name');
            $table->string('agency_email')->nullable();
            $table->string('agency_phone')->nullable();
            $table->text('agency_siege')->nullable();
            $table->foreignId('matched_agency_id')->nullable()->constrained('agencies')->onDelete('set null');
            $table->float('match_score');
            $table->enum('internet_check', ['unknown', 'exists', 'not_found'])->default('unknown');
            $table->boolean('is_flagged')->default(false);
            $table->string('ip_address')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
