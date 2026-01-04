<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('careers', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title');
            $table->text('job_descriptions');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('is_publish', ['Publish', 'Draft'])->default('Draft');
            $table->boolean('is_delete')->default(false);
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
