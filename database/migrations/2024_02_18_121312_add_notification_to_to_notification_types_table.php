<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('notification_types', function (Blueprint $table) {
            $table->unsignedBigInteger('notification_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('notification_types', function (Blueprint $table) {
            $table->dropColumn('notification_to');
        });
    }
};
