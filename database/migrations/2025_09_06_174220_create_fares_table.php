<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->string('cabin_class');            // Economy, Business...
            $table->string('fare_code')->nullable();   // e.g. Y, M, B
            $table->string('fare_type')->nullable();   // Saver, Flex, etc.
            $table->decimal('price', 10, 2);
            $table->integer('seats_left')->default(9);
            $table->boolean('refundable')->default(false);
            $table->string('baggage')->nullable();     // override baggage text
            $table->json('rules')->nullable();         // JSON for cancellation/reschedule rules
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('fares');
    }
};
