<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnerTotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('UPDATE owners set total_addresses = (SELECT count(*) FROM addresses WHERE owners.id = addresses.owner_id)');
        DB::statement('UPDATE owners set total_cars = (SELECT count(*) FROM cars WHERE owners.id = cars.owner_id)');
        
    }
}
