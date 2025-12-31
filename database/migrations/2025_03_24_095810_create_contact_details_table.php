<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_details', function (Blueprint $table) {

            $table->increments('id');
            $table->string('heading')->nullable();
            $table->text('heading_description')->nullable();
            $table->text('address_info')->nullable();
            $table->text('branch_office')->nullable();
            $table->text('head_office')->nullable();
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('email');
            $table->string('email2')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('Linkedin_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('whatsapp_link')->nullable();

            $table->text('map')->nullable();

            $table->string('company_logo');
            $table->string('fav_image')->nullable();

            $table->string('company_name');
            $table->text('company_description')->nullable();

            $table->string('subscription')->nullable();

            $table->string('seo_image')->nullable();
            $table->string('seo_title');
            $table->text('seo_description');
            $table->text('seo_keywords'); // NOT NULL

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_details');
    }
};
