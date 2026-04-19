<?php
// database/migrations/2024_01_01_000000_create_binance_withdrawals_table.php

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
        Schema::create('binance_withdrawals', function (Blueprint $table) {
            $table->id();
            
            // User relationship
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Transaction details
            $table->string('transaction_id')->unique()->nullable(); // Will be filled by admin/vendor
            $table->string('binance_id'); // Binance ID/UID (required field)
            
            // Amount details
            $table->decimal('amount', 10, 2); // USDT amount
            $table->integer('points_required'); // Points used for this withdrawal
            
            // Status tracking
            $table->string('status')->default('pending'); // pending, processing, completed, failed, cancelled
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('user_id');
            $table->index('status');
            $table->index('binance_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binance_withdrawals');
    }
};