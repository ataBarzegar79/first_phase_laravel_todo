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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('user_id'); // todo : you have used wrong way of using foreign keys ! : https://laravel.com/docs/10.x/migrations#column-method-foreignId:~:text=%24table%2D%3EforeignId(%27user_id%27)%2D%3Econstrained()%3B
            $table->string('select')->nullable(); // todo : It seems that you haven't chosen a nice name for your column, change it to a readable one. it can be task_status or status. Also you haven't used a true data type , you should use enums.
            $table->string('title');
            $table->string('slug'); // todo: todo : It seems that you haven't chosen a nice name for your column, change it to a readable one. it can be task_status or status.
            $table->timestamp('time')->nullable(); // todo : It seems that you haven't chosen a nice name for your column, change it to a readable one.
            $table->timestamps();
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
