<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTotalsToOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->integer('total_addresses')->unsigned()->nullable();
            $table->integer('total_cars')->unsigned()->nullable();
        });
        
        DB::statement('UPDATE owners set total_addresses = (SELECT count(*) FROM addresses WHERE owners.id = addresses.owner_id)');
        DB::statement('UPDATE owners set total_cars = (SELECT count(*) FROM cars WHERE owners.id = cars.owner_id)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('total_addresses');
            $table->dropColumn('total_cars');
        });
    }
}
