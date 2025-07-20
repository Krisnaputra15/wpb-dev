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
        Schema::create('booth_layouts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('layout_id')->nullable()->constrained('layouts')->restrictOnDelete()->restrictOnUpdate();
            $table->foreignUuid('booth_id')->nullable()->constrained('booths')->restrictOnDelete()->restrictOnUpdate();
            $table->string('label',10);
            $table->string('positions');
            $table->string('position_start', 10)->nullable();
            $table->string('position_end', 10)->nullable();
            $table->string('booth_pov_file', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booth_layouts');
    }
};
