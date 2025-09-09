<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('airlines', function (Blueprint $table) {
            $table->id();
            $table->string('iata', 3)->unique();
            $table->string('icao', 3)->nullable();
            $table->string('name');
            $table->string('country')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('airlines');
    }
};
