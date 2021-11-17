<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesNamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('UPDATE addresses set total_cars = (SELECT count(*) FROM cars WHERE addresses.id = cars.address_id)');
        DB::statement('UPDATE addresses set owner_name = (SELECT concat(first_name,\' \',last_name) FROM owners WHERE owners.id = addresses.owner_id)');
    }
}
