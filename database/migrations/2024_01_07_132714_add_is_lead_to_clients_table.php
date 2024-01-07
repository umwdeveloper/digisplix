<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('clients', function (Blueprint $table) {
            $table->tinyInteger('is_lead')->default(1)->comment('0=false, 1=true');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('is_lead');
        });
    }
};
