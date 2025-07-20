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
            $table->string('tax_payment_proof_file', 1000)->nullable()->after('payment_proof_file');
            $table->text('documentation_link')->nullable()->after('tax_payment_proof_file');
            $table->text('applicant_recap_link')->nullable()->after('documentation_link');
            $table->text('additional_transaction_items')->nullable()->after('additional_request');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booth_transactions', function (Blueprint $table) {
            $table->dropColumn('tax_payment_proof_file');
            $table->dropColumn('documentation_link');
            $table->dropColumn('applicant_recap_link');
            $table->dropColumn('additional_transaction_items');
        });
    }
};
