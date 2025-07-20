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
        Schema::create('agenda_participants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('agenda_id')->constrained('agendas')->restrictOnDelete()->restrictOnUpdate();
            $table->foreignUuid('user_id')->constrained('users')->restrictOnDelete()->restrictOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_participants');
    }
};
