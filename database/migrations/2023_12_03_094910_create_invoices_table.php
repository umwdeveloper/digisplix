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
            $table->text('invoice_from')->nullable();
            $table->text('invoice_to')->nullable();
            $table->enum('status', ['pending', 'paid', 'overdue', 'draft', 'cancelled'])->default('pending');
            $table->tinyInteger('sent')->default(0)->comment('0=Not Sent, 1=Sent');
            $table->date('due_date');
            $table->text('terms_n_conditions')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('recurring')->default(0)->comment('0=Recurring, 1=Non recurring');
            $table->date('start_from')->nullable();
            $table->unsignedInteger('duration')->nullable();

            // $table->string('account_holder_name')->nullable();
            // $table->string('bank_name')->nullable();
            // $table->string('ifsc_code')->nullable();
            // $table->string('account_number')->nullable();

            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('invoices');
    }
};
