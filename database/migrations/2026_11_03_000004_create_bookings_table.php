<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->string('booking_code')->unique();
                $table->foreignId('guest_id')->constrained()->restrictOnDelete();
                $table->foreignId('room_id')->constrained()->restrictOnDelete();
                $table->foreignId('user_id')->constrained()->restrictOnDelete();
                $table->date('check_in');
                $table->date('check_out');
                $table->unsignedInteger('guests_count')->default(1);
                $table->decimal('total_amount', 12, 2)->default(0);
                $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
                $table->text('notes')->nullable();
                $table->timestamps();
            });

            return;
        }

        $foreignKeys = Schema::getForeignKeys('bookings');
        $hasUserForeignKey = collect($foreignKeys)->contains(
            fn (array $foreignKey): bool => in_array('user_id', $foreignKey['columns'], true),
        );
        $hasBookingCodeUniqueIndex = Schema::hasIndex('bookings', 'bookings_booking_code_unique', 'unique');

        if ($hasUserForeignKey && $hasBookingCodeUniqueIndex) {
            return;
        }

        Schema::table('bookings', function (Blueprint $table) use ($hasUserForeignKey, $hasBookingCodeUniqueIndex): void {
            if (! $hasUserForeignKey) {
                $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
            }

            if (! $hasBookingCodeUniqueIndex) {
                $table->unique('booking_code');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
