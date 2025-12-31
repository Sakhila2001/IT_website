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
        Schema::create('why_choose_us_heading', function (Blueprint $table) {
            $table->increments('id');
            $table->string('small_heading');
            $table->string('heading');
            $table->text('heading_description');
            $table->string('banner_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_choose_us_heading');
    }
};
