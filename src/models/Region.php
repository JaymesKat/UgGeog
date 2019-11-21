<?php

namespace JaymesKat\UgGeog\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use JaymesKat\UgGeog\Models\District;

class Region extends Model
{

    /**
     * Get all regions
     */
    public static function list()
    {
        $columns = 'distinct region,
                    count(distinct district) AS number_of_districts,
                    SUM(number_of_males) AS male_population,
                    SUM(number_of_females) AS female_population,
                    SUM(number_of_males)+SUM(number_of_females) AS total_population,
                    ROUND(1.0*SUM(number_of_males)/SUM(number_of_females), 2) AS male_to_female_ratio';

        return DB::table('uganda_regions')->select(DB::raw($columns))->groupBy('region')->get()->all();
    }

    /**
     * Get details about a region and the districts therein
     *
     * @param $region_name
     * @return array
     *
     */
    public static function get($region_name)
    {
        $columns = 'distinct region,
                    count(distinct district) AS number_of_districts,
                    SUM(number_of_males) AS male_population,
                    SUM(number_of_females) AS female_population,
                    SUM(number_of_males)+SUM(number_of_females) AS total_population,
                    ROUND(1.0*SUM(number_of_males)/SUM(number_of_females), 2) AS male_to_female_ratio';

        if (!DB::table('uganda_regions')->select(DB::raw('distinct region'))->get()->contains('region', trim($region_name))) {
            return ['error' => 'region not found'];
        }
        $resultsArr = DB::table('uganda_regions')->select(DB::raw($columns))->where('region', 'LIKE', trim($region_name))->groupBy('region')->get()->all();
        $resultsArr['districts'] = District::inRegion(trim($region_name));
        return $resultsArr;
    }
}
