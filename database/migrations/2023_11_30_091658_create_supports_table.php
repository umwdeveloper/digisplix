<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('subject');
            $table->text('description')->nullable();
            $table->enum('status', ['open', 'awaiting_user_response', 'user_replied', 'closed'])->default('open');
            $table->tinyInteger('priority')->default(0)->comment('0=Low, 1=Medium, 2=High');
            $table->tinyInteger('department')->default(0)->comment('0=General, 1=Sales/Billing, 2=Technical');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('supports');
    }
};
