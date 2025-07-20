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
            $table->text('feature_request')->nullable()->after('total_price')->change();
            $table->text('additional_request')->nullable()->after('feature_request')->change();
            $table->date('payment_date')->nullable()->after('is_paid')->change();
            $table->string('payment_type')->nullable()->after('surat_permohonan_file')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booth_transactions', function (Blueprint $table) {
            $table->text('feature_request')->after('total_price')->change();
            $table->text('additional_request')->after('feature_request')->change();
            $table->date('payment_date')->after('is_paid')->change();
            $table->string('payment_type')->after('surat_permohonan_file')->change();
        });
    }
};
