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
        Schema::create('registered_booths', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('booth_layout_id')->constrained('booth_layouts')->restrictOnDelete();
            $table->foreignUuid('agenda_id')->constrained('agendas')->restrictOnDelete();
            $table->foreignUuid('booth_transaction_id')->nullable()->constrained('booth_transactions')->restrictOnDelete();
            $table->boolean('is_booked')->default(0);
            $table->integer('fixed_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registered_booths');
    }
};
