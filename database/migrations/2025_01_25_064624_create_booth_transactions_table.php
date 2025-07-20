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
        Schema::create('booth_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('participant_id')->constrained('agenda_participants')->restrictOnDelete()->restrictOnUpdate();
            $table->integer('total_price');
            $table->text('feature_request');
            $table->text('additional_request');
            $table->boolean('is_paid')->default(0);
            $table->date('payment_date');
            $table->boolean('is_verified')->default(0);
            $table->boolean('is_payment_verified')->default(0);
            $table->string('surat_permohonan_file', 1000)->nullable();
            $table->string('payment_type');
            $table->string('payment_proof_file', 1000)->nullable();
            $table->string('invoice_file', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booth_transactions');
    }
};
