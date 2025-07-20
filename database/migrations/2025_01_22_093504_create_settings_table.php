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
        Schema::create('settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('default_email', 500)->nullable();
            $table->text('message_template')->nullable();
            $table->string('default_wa_number', 15)->nullable();
            $table->string('booth_bank_account_code', 4)->nullable();
            $table->string('booth_bank_account_name', 255)->nullable();
            $table->string('booth_bank_account_number', 255)->nullable();
            $table->string('tax_bank_account_code', 4)->nullable();
            $table->string('tax_bank_account_name', 255)->nullable();
            $table->string('tax_bank_account_number', 255)->nullable();
            $table->string('surat_permohonan_template_file', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
