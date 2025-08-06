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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('conversation_id')->constrained();
            $table->foreignId('user_id')->constrained();

            $table->text('body')->nullable();
            $table->string('type')->default('text');

            $table->unsignedBigInteger('reply_to_id')->nullable();
            $table->foreign('reply_to_id')->references('id')->on('messages');

            $table->timestamp('edited_at')->nullable();
            $table->string('status')->default('sent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
