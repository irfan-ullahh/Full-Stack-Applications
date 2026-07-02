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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            $table->decimal('old_balance_sender', 10, 2)->nullable();
            $table->decimal('new_balance_sender', 10, 2)->nullable();
            $table->decimal('old_balance_receiver', 10, 2)->nullable();
            $table->decimal('new_balance_receiver', 10, 2)->nullable();
            $table->string('performed_by', 50)->nullable();
            $table->timestamps();
            
            $table->index('transaction_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
