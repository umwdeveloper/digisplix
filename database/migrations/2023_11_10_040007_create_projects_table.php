<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('name');
            $table->text('description');
            $table->tinyInteger('billing_status')->default(1)->comment('0=Unpaid, 1=Paid');
            $table->tinyInteger('current_status')->default(0)->comment('0=Ongoing, 1=Completed');
            $table->unsignedInteger('progress')->default(0);
            $table->text('img')->nullable();
            $table->date('deadline');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('projects');
    }
};
