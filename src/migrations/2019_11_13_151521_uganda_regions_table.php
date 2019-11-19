<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UgandaRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('uganda_regions', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('region');
            $table->string('district');
            $table->string('subcounty');
            $table->integer('number_of_males')->nullable();
            $table->integer('number_of_females')->nullable();
            $table->float('land_area_sq_km', 8, 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('uganda_regions');
    }
}
