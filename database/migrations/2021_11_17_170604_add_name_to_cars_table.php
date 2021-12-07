<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddNameToCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('owner_name_address', 128)->nullable();
        });

        $sql = <<<SQL
        UPDATE cars SET owner_name_address = concat(
            (SELECT concat(first_name,' ',last_name) FROM owners WHERE owners.id = cars.owner_id),
            ' ',
            (SELECT concat_ws(', ',address,city,postal_code,country) FROM addresses WHERE cars.address_id = addresses.id)
        )
        SQL;
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('owner_name_address');
        });
    }
}
