<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_category_id')->constrained('service_categories')->onDelete('cascade');
            $table->string('business_name');
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->string('area');
            $table->string('pincode');
            $table->text('description');
            $table->text('experience')->nullable();
            $table->json('documents')->nullable();
            $table->enum('status', ['available', 'working', 'free', 'on_leave'])->default('available');
            $table->boolean('is_approved')->default(false);
            $table->decimal('base_price', 10, 2)->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_providers');
    }
};