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
        Schema::create('failed_rows', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('message');
            $table->unsignedBigInteger('row')->nullable();
            $table->foreignId('task_id')->index()->constrained('tasks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_rows');
    }
};
