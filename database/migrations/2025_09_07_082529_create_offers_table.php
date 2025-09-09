<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Offer title
            $table->text('description'); // Offer description
            $table->string('code')->nullable(); // Coupon code (e.g. SAVE20), null = no code
            $table->enum('journey_type', ['domestic','international'])->nullable();
            $table->enum('category', ['special','bank','hotel','flight','bus','cab']);
            $table->string('bank')->nullable(); // Bank name if applicable
            $table->date('expires_at')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
