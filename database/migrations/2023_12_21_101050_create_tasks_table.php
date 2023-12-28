<?php

use App\Enums\StatusEnum;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('title');
            $table->text('body');
            $table->timestamp('starting_time');
            $table->timestamp('finishing_time');
            $table->string('slug', 100);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['Done', 'In Progress'])->default('In Progress');
            $table->timestamp('completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
