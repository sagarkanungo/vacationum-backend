<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        // Fill UUIDs for existing flights
        DB::table('flights')->whereNull('uuid')->orWhere('uuid', '')->get()->each(function ($flight) {
            DB::table('flights')->where('id', $flight->id)->update([
                'uuid' => Str::uuid()
            ]);
        });

        // Now add unique constraint
        Schema::table('flights', function ($table) {
            $table->uuid('uuid')->unique()->change();
        });
    }

    public function down(): void {
        Schema::table('flights', function ($table) {
            $table->dropUnique(['uuid']);
        });
    }
};
