<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Subcounty;

class District extends Model
{

    /**
     * Get all districts
     */
    public static function list()
    {
        $dbColumns = 'distinct district AS district_name,
                      count(distinct subcounty) AS number_of_subcounties,
                      SUM(number_of_males) AS male_population,
                      SUM(number_of_females) AS female_population,
                      (SUM(number_of_males)+SUM(number_of_females)) AS total_population,
                      ROUND((SUM(number_of_males)*1.0/SUM(number_of_females)), 2) AS male_to_female_ratio';

        return DB::table('uganda_regions')->select(DB::raw($dbColumns))->groupBy('district')->get()->all();
    }

    /**
     * Get districts within a region
     */
    public static function inRegion($region_name){
        $dbColumns = 'distinct district AS district_name,
                      count(distinct subcounty) AS number_of_subcounties,
                      number_of_males AS male_population,
                      number_of_females AS female_population,
                      number_of_males+number_of_females AS total_population,
                      ROUND((number_of_males*1.0/number_of_females), 2) AS male_to_female_ratio';

        if (!DB::table('uganda_regions')->select(DB::raw('distinct region'))->get()->contains('region', trim($region_name))) {
            return ['error' => 'region not found'];
        }
        return DB::table('uganda_regions')->select(DB::raw($dbColumns))->where('region', 'like', trim($region_name))->groupby('district')->get()->all();
    }

    /**
     * Get info for single district:
     * name, region, male population, female population, total population, gender ratio and array of subcounties
     */
    public static function get($district_name)
    {

        if (!DB::table('uganda_regions')->select(DB::raw('distinct district'))->get()->contains('district', trim($district_name))) {
            return ['error' => 'district not found'];
        }

        $columns = 'district as district_name,
                    region,
                    SUM(number_of_males) AS male_population,
                    SUM(number_of_females) AS female_population,
                    (SUM(number_of_males)+SUM(number_of_females)) AS total_population,
                    ROUND(number_of_males*1.0/number_of_females, 2) AS male_to_female_ratio,
                    count(subcounty) as number_of_subcounties';

        $resultsArr = DB::table('uganda_regions')->select(DB::raw($columns))->where('district', 'like', trim($district_name))->groupBy(trim($district_name))->get()->all();
        $resultsArr['subcounties'] = Subcounty::inDistrict(trim($district_name));
        return $resultsArr;
    }
}
