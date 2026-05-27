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
        Schema::create('sms_logs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | FIXED FOREIGN KEY
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('sender_id_id')->nullable();

            $table->foreign('sender_id_id')
                ->references('id')
                ->on('senderids')
                ->nullOnDelete();

            $table->string('phone_number');

            $table->text('message');

            $table->string('route')->nullable();

            $table->decimal('cost', 10, 4)->default(0);

            $table->string('status')->default('pending');

            $table->string('provider')->nullable();

            $table->string('provider_message_id')->nullable();

            $table->timestamp('sent_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_logs');
    }
};