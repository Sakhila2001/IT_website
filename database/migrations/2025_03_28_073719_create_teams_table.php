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
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('designation')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default('0');
            $table->string('facebook_link')->nullable();
            $table->string('Linkedin_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->enum('is_publish', ['Publish', 'Draft'])->default('Draft');
            $table->boolean('is_delete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
