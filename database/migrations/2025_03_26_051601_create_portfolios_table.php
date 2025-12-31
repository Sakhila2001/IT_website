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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('portfolio_category_id');
            $table->string('image');
            $table->enum('is_publish', ['Publish', 'Draft'])->default('Draft');
            $table->boolean('is_delete')->default(false);
            $table->timestamps();
            $table->foreign('portfolio_category_id')
            ->references('id')->on('portfolio_categories')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropForeign(['portfolio_category_id']);
        });
        Schema::dropIfExists('portfolios');
    }
};
