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
        Schema::table('booths', function (Blueprint $table) {
            $table->decimal('length_in_m');
            $table->decimal('width_in_m');
            $table->decimal('height_in_m');
            $table->text('facilities');
            $table->text('branding_facilities');
            $table->integer('lo_count');
            $table->string('lo_performance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booths', function (Blueprint $table) {
            $table->dropColumn('length_in_m');
            $table->dropColumn('width_in_m');
            $table->dropColumn('height_in_m');
            $table->dropColumn('facilities');
            $table->dropColumn('branding_facilities');
            $table->dropColumn('lo_count');
            $table->dropColumn('lo_performance');
        });
    }
};
