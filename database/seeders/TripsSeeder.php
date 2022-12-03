<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\Station;
use App\Models\Trip;
use Illuminate\Database\Seeder;

class TripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'bus' => '001',
                'stations' => [
                    'Giza',
                    'Cairo',
                    'Qaliubiya',
                    'Gharbiya',
                    'Beheira',
                    'Alexandria',
                    'Matrouh'
                ]
            ],
            [
                'bus' => '002',
                'stations' => [
                    'Cairo',
                    'Giza',
                    'Fayoum',
                    'Beni Suef',
                    'Minya',
                    'Assiut',
                    'Sohag',
                    'Qena',
                    'Luxor',
                    'Aswan'
                ]
            ],
            [
                'bus' => '003',
                'stations' => [
                    'Dakahlia',
                    'Damietta',
                    'Port Said',
                    'Ismailia',
                    'Suez',
                    'Red Sea'
                ]
            ],
            [
                'bus' => '004',
                'stations' => [
                    'Damietta',
                    'Dakahlia',
                    'Gharbiya',
                    'Kafr Al sheikh',
                    'Beheira',
                    'Alexandria'
                ]
            ],
        ];

        foreach ($records as $record) {
            $bus = Bus::create(['name' => $record['bus']]);
            $trip = Trip::create(['bus_id' => $bus->id]);
            foreach ($record['stations'] as $index => $stationName) {
                $station = Station::where('name', $stationName)->first();
                $trip->stations()->attach($station->id, ['order' => ($index + 1)]);
            }
        }
    }
}
