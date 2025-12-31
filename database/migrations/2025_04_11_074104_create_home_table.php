<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('home', function (Blueprint $table) {

            $table->increments('id');
            $table->string('hot_heading_section')->nullable();
            $table->string('heading')->nullable();
            $table->text('heading_description')->nullable();
            $table->string('slug')->nullable();
            $table->string('seo_title');
            $table->text('seo_description');
            $table->text('seo_keywords');
            $table->string('seo_image')->nullable();
            $table->string('hero_background_image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home');
    }
};
