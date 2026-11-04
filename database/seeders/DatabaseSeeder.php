<?php

namespace Database\Seeders;

use App\Models\RoomType;
use App\Models\Room;
use App\Models\Guest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $standard = RoomType::firstOrCreate(['name' => 'Standard'], [
            'description' => 'Comfortable room for everyday stays.', 'base_price' => 25, 'capacity' => 2,
        ]);
        $deluxe = RoomType::firstOrCreate(['name' => 'Deluxe'], [
            'description' => 'Spacious room with upgraded amenities.', 'base_price' => 45, 'capacity' => 3,
        ]);
        $suite = RoomType::firstOrCreate(['name' => 'Suite'], [
            'description' => 'Premium suite for a relaxing stay.', 'base_price' => 80, 'capacity' => 4,
        ]);

        foreach ([['101', $standard, 25], ['102', $standard, 25], ['201', $deluxe, 45], ['301', $suite, 80]] as [$number, $type, $price]) {
            Room::firstOrCreate(['room_number' => $number], [
                'room_type_id' => $type->id, 'floor' => (int) substr($number, 0, 1),
                'status' => 'available', 'price' => $price,
            ]);
        }

        Guest::firstOrCreate(['phone' => '012345678'], [
            'full_name' => 'Sample Guest', 'email' => 'guest@example.com',
            'gender' => 'other', 'address' => 'Phnom Penh, Cambodia',
        ]);
    }
}
