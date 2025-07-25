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
        Schema::table('booth_transactions', function (Blueprint $table) {
            $table->string('faktur_file', 1000)->nullable()->after('surat_permohonan_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booth_transactions', function (Blueprint $table) {
            $table->dropColumn('faktur_file');
        });
    }
};
