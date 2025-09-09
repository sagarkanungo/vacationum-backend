<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36);
            $table->foreignId('airline_id')->constrained('airlines')->onDelete('cascade');
            $table->string('flight_number');
            $table->foreignId('origin_airport_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('destination_airport_id')->constrained('airports')->onDelete('cascade');
            $table->dateTime('departure_at');
            $table->dateTime('arrival_at');
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('duration_minutes')->nullable();
            $table->integer('stops')->default(0);
            $table->string('equipment')->nullable();
            $table->string('terminal_from')->nullable();
            $table->string('terminal_to')->nullable();
            $table->json('baggage_info')->nullable();
            $table->json('seats')->nullable();
            $table->json('meals')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('flights');
    }
};
