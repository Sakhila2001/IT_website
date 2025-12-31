<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about', function (Blueprint $table) {

            $table->increments('id');
            $table->string('heading');
            $table->string('small_heading')->nullable();
            $table->string('banner_image')->nullable();
            $table->text('description');
            $table->text('core_description');
            $table->text('mission_description');
            $table->text('vision_description');
            $table->integer('years_of_experience');
            $table->integer('no_of_employees');
            $table->integer('no_of_users');
            $table->integer('no_of_satisfied_clients');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('slug')->nullable();
            $table->string('counter_image')->nullable();
            $table->string('seo_title');
            $table->text('seo_description');
            $table->text('seo_keywords');
            $table->string('seo_image')->nullable();
            $table->enum('is_publish', ['Publish', 'Draft'])->default('Draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about');
    }
};
