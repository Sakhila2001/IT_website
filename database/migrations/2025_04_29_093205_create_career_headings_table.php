<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('career_headings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('small_heading');
            $table->string('heading');
            $table->text('heading_description');
            $table->string('seo_image')->nullable();
            $table->string('seo_title');
            $table->text('seo_description');
            $table->text('seo_keywords');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_headings');
    }
};
