<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phase_id');
            $table->string('task');
            $table->tinyInteger('status')->default(0)->comment('0=pending, 1=complete');
            $table->timestamps();

            $table->foreign('phase_id')->references('id')->on('phases')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('tasks');
    }
};
