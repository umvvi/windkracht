<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PersonalInformation;
use App\Models\Location;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\Lesson;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create owner
        $owner = User::create([
            'email' => 'terence@windkracht12.nl',
            'password' => Hash::make('Owner@Password123'),
            'role' => 'owner',
            'is_active' => true,
        ]);

        PersonalInformation::create([
            'user_id' => $owner->id,
            'first_name' => 'Terence',
            'last_name' => 'Olieslager',
            'street_address' => 'Kitelaan 1',
            'city' => 'Utrecht',
            'postal_code' => '3500AA',
            'date_of_birth' => '1975-05-20',
            'phone_mobile' => '0612345678',
            'bsn' => '123456789',
        ]);

        // Create instructors
        $instructorNames = [
            ['Duco', 'Veenstra'],
            ['Waldemar', 'van Dongen'],
            ['Ruud', 'Terlingen'],
            ['Saskia', 'Brink'],
            ['Bernie', 'Vredenstein'],
        ];

        $instructors = [];
        foreach ($instructorNames as $index => [$first, $last]) {
            $instructor = User::create([
                'email' => strtolower("{$first}.{$last}@windkracht12.nl"),
                'password' => Hash::make('Instructor@Password123'),
                'role' => 'instructor',
                'is_active' => true,
            ]);

            PersonalInformation::create([
                'user_id' => $instructor->id,
                'first_name' => $first,
                'last_name' => $last,
                'street_address' => "Straat " . ($index + 1),
                'city' => 'Utrecht',
                'postal_code' => '3500AA',
                'date_of_birth' => Carbon::parse("1980-01-15")->addYears($index)->toDateString(),
                'phone_mobile' => '061234567' . $index,
                'bsn' => '12345678' . $index,
            ]);

            $instructors[] = $instructor;
        }

        // Create customers
        for ($i = 1; $i <= 10; $i++) {
            $customer = User::create([
                'email' => "customer{$i}@example.com",
                'password' => Hash::make('Customer@Password123'),
                'role' => 'customer',
                'is_active' => true,
            ]);

            PersonalInformation::create([
                'user_id' => $customer->id,
                'first_name' => "Customer{$i}",
                'last_name' => "Surname{$i}",
                'street_address' => "Customerlaan {$i}",
                'city' => 'Amsterdam',
                'postal_code' => '1000AA',
                'date_of_birth' => Carbon::parse("1990-01-01")->addMonths($i)->toDateString(),
                'phone_mobile' => '0698765432' . str_pad($i, 1, '0', STR_PAD_LEFT),
            ]);
        }

        // Create locations
        $locationData = [
            ['Zandvoort', 'Zandvoort', 'Beachfront kitesurfing location near Amsterdam'],
            ['Muiderberg', 'Muiderberg', 'Scenic spot with good wind conditions'],
            ['Wijk aan Zee', 'Wijk aan Zee', 'Popular beach location in North Holland'],
            ['IJmuiden', 'IJmuiden', 'Northern location with consistent wind'],
            ['Scheveningen', 'Scheveningen', 'Beach town near The Hague'],
            ['Hoek van Holland', 'Hoek van Holland', 'Southern coastal location'],
        ];

        $locations = [];
        foreach ($locationData as [$name, $city, $description]) {
            $location = Location::create([
                'name' => $name,
                'city' => $city,
                'description' => $description,
            ]);
            $locations[] = $location;
        }

        // Create packages
        $packages = [
            [
                'name' => 'Privéles 2,5 uur',
                'type' => 'private',
                'duration_hours' => 2.5,
                'price_per_person' => 175,
                'num_sessions' => 1,
                'description' => 'Private lesson including equipment rental',
            ],
            [
                'name' => 'Losse Duo Kiteles 3,5 uur',
                'type' => 'duo',
                'duration_hours' => 3.5,
                'price_per_person' => 135,
                'num_sessions' => 1,
                'description' => 'Single duo lesson including equipment rental',
            ],
            [
                'name' => 'Kitesurf Duo lespakket 3 lessen 10,5 uur',
                'type' => 'duo',
                'duration_hours' => 3.5,
                'price_per_person' => 375,
                'num_sessions' => 3,
                'description' => '3-lesson package for two people',
            ],
            [
                'name' => 'Kitesurf Duo lespakket 5 lessen 17,5 uur',
                'type' => 'duo',
                'duration_hours' => 3.5,
                'price_per_person' => 675,
                'num_sessions' => 5,
                'description' => '5-lesson package for two people',
            ],
        ];

        foreach ($packages as $packageData) {
            Package::create($packageData);
        }

        // Create some sample reservations and lessons
        $customers = User::where('role', 'customer')->get();
        $packageList = Package::all();

        foreach ($customers->take(5) as $customer) {
            $package = $packageList->random();
            $location = collect($locations)->random();
            $instructor = collect($instructors)->random();

            $reservation = Reservation::create([
                'customer_id' => $customer->id,
                'package_id' => $package->id,
                'location_id' => $location->id,
                'status' => 'confirmed',
                'payment_received' => true,
                'payment_date' => Carbon::now(),
                'total_price' => $package->price_per_person * ($package->type === 'duo' ? 2 : 1),
            ]);

            // Create lessons for this reservation
            for ($i = 0; $i < $package->num_sessions; $i++) {
                $startTime = Carbon::now()->addDays($i * 3)->setHour(9)->setMinute(0);
                $endTime = $startTime->copy()->addMinutes($package->duration_hours * 60);

                Lesson::create([
                    'reservation_id' => $reservation->id,
                    'instructor_id' => $instructor->id,
                    'location_id' => $location->id,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'status' => 'scheduled',
                ]);
            }
        }
    }
}
