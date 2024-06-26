<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->nullable();
            $table->string('url')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_phone')->nullable();
            $table->tinyInteger('active')->default(0)->comment('0=inactive, 1=active');
            $table->tinyInteger('is_client')->default(0)->comment('0=no, 1=yes');
            $table->enum('status', ['new_lead', 'contacted', 'follow_up', 'in_progress', 'failed', 'qualified'])->default('new_lead');
            $table->timestamp('joined_at')->default(now())->nullable();
            $table->timestamp('followup_date')->default(now())->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('clients');
    }
};
