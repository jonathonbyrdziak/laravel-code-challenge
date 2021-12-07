<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddNamesToAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('owner_name', 128)->nullable();
            $table->integer('total_cars')->unsigned()->nullable();
            
        });
            
        DB::statement('UPDATE addresses set total_cars = (SELECT count(*) FROM cars WHERE addresses.id = cars.address_id)');
        DB::statement('UPDATE addresses set owner_name = (SELECT concat(first_name,\' \',last_name) FROM owners WHERE owners.id = addresses.owner_id)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('owner_name');
            $table->dropColumn('total_cars');
        });
    }
}
