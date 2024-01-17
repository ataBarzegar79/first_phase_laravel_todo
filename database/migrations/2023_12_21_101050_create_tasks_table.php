<?php

use App\Enums\StatusEnum; // todo : what is this ?
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
        // todo : I didn't manage to run this migration. This problem occurred :   SQLSTATE[42000]: Syntax error or access violation: 1067 Invalid default value for 'ended_at' (Connection: mysql, SQL: create table `tasks` (`id` bigint unsigned not null auto_increment primary key, `created_at` timestamp null, `updated_at` timestamp null, `title` text not null, `body` text not null, `started_at` timestamp not null default '2024-01-17 14:01:15', `ended_at` timestamp not null, `slug` varchar(100) not null, `user_id` bigint unsigned not null, `status` enum('Done', 'In Progress') not null default 'In Progress', `completed_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci')
        // I'm currently using Maria DB : 10.6
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('title');
            $table->text('body');
            $table->timestamp('started_at');
            $table->timestamp('ended_at');
            $table->string('slug', 100); // todo : what is goal of slug?
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['Done', 'In Progress'])->default('In Progress'); //todo : use enums in your php code.
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
