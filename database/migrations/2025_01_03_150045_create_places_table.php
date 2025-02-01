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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text')->nullable();
            $table->string('alias');
            $table->string('coordinates')->nullable();
            $table->integer('object_category')->nullable();
            $table->text('image')->nullable();
            $table->text('gallery')->nullable();
            $table->string('address')->nullable();
            $table->string('tags')->nullable();
            $table->string('filters')->nullable();
            $table->string('recommendation')->nullable();
            $table->integer('event_duration')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
