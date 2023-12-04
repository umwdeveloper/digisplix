<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('category_id');
            $table->enum('status', ['pending', 'paid', 'overdue', 'draft', 'recurring', 'cancelled'])->default('pending');
            $table->tinyInteger('sent')->default(0)->comment('0=Not Sent, 1=Sent');
            $table->date('due_date');
            $table->text('terms_n_conditions')->nullable();
            $table->text('note')->nullable();
            $table->string('signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('invoices');
    }
};
