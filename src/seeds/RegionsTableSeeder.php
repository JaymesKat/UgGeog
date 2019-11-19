<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $contents = file_get_contents(__DIR__.'/../../storage/ug_geog_data.json');
        $regionsArr =  json_decode($contents, true);

        foreach($regionsArr as $region){
            DB::table('uganda_regions')->insert([
                'region' => $region['Region'],
                'district' => $region['District'],
                'subcounty' => $region['Sub-county'],
                'number_of_males' => intval(str_replace(",", "", $region['Male'])),
                'number_of_females' => intval(str_replace(",", "", $region['Female'])),
                'land_area_sq_km' => $region['Land Area (Sq. Km)'],
            ]);
        }
    }
}
