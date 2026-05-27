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
        Schema::create('call_logs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('caller_id_id')
                ->nullable()
                ->constrained('caller_ids')
                ->onDelete('set null');

            $table->string('phone');

            $table->decimal('duration', 12, 2)
                ->default(0);

            $table->decimal('cost', 12, 2)
                ->default(0);

            $table->enum('status', [
                'initiated',
                'ringing',
                'answered',
                'failed',
                'completed',
            ])->default('initiated');

            $table->string('provider')
                ->nullable();

            $table->string('provider_call_id')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_logs');
    }
};