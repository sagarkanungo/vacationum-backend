<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('iata', 3)->unique();
            $table->string('icao', 4)->nullable();
            $table->string('name');
            $table->string('city');
            $table->string('country');
            $table->string('timezone')->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('airports');
    }
};
