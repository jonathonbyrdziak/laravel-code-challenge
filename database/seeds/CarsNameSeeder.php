<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sql = <<<SQL
        UPDATE cars SET owner_name_address = concat(
            (SELECT concat(first_name,' ',last_name) FROM owners WHERE owners.id = cars.owner_id),
            ' ',
            (SELECT concat_ws(', ',address,city,postal_code,country) FROM addresses WHERE cars.address_id = addresses.id)
        )
        SQL;
        DB::statement($sql);
    }
}
