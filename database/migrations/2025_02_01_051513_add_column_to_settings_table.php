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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('booth_bank_account_owner')->nullable()->after('booth_bank_account_number');
            $table->string('tax_bank_account_owner')->nullable()->after('tax_bank_account_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('booth_bank_account_owner');
            $table->dropColumn('tax_bank_account_owner');
        });
    }
};
