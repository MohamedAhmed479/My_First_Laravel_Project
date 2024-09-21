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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->unsignedBigInteger('conversation_id'); // Conversation thread ID
            $table->unsignedBigInteger('sender_id'); // Sender ID
            $table->unsignedBigInteger('receiver_id'); // Receiver ID
            $table->text('message'); // Message content
            $table->timestamp('sent_at')->useCurrent(); // Message sent timestamp
            $table->enum('status', ['sent', 'delivered', 'read'])->default('sent'); // Message status
            $table->boolean('is_customer'); // Flag to identify if the sender is a customer
            $table->timestamps();

            // Foreign key constraints (assuming you have a 'users' table)
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
