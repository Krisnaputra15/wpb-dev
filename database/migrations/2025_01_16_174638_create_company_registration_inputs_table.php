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
        Schema::create('company_registration_inputs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('column_name', 500);
            $table->string('column_label', 500);
            $table->string('column_type', 255);
            $table->boolean('is_nullable')->default(0);
            $table->string('default_value', 500)->nullable();
            $table->string('list_value', 1000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_registration_inputs');
    }
};
