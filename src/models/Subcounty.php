<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Subcounty extends Model
{

    private static $dbColumns = 'subcounty AS subcounty_name,
                                district AS district_name,
                                region,
                                number_of_males AS male_population,
                                number_of_females AS female_population,
                                number_of_males+number_of_females AS total_population,
                                land_area_sq_km,
                                ROUND(number_of_males*1.0/number_of_females, 2) AS "male_to_female_ratio",
                                CAST(ROUND((number_of_males+number_of_females)/land_area_sq_km, 0) AS int) AS "population_density"';
    /**
     * Get all subcounties
     */
    public static function list()
    {
        return DB::table('uganda_regions')->select(DB::raw(self::$dbColumns))->get()->all();
    }

    /**
     * Get single subcounty: name, district, region, male population, female population, total population, land area, gender ratio
     *
     * @param $subcounty_name
     * @return array
     */
    public static function get($subcounty_name)
    {
        if (!DB::table('uganda_regions')->select(DB::raw('subcounty'))->get()->contains('subcounty', trim($subcounty_name))) {
            return ['error' => 'subcounty not found'];
        }
        return DB::table('uganda_regions')->select(DB::raw(self::$dbColumns))->where('subcounty', 'LIKE', trim($subcounty_name))->get()->all();
    }

    /**
     * Get all subcounties within district
     *
     * @param $district_name
     * @return
     */
    public static function inDistrict($district_name)
    {
        if (!DB::table('uganda_regions')->select(DB::raw('distinct district'))->get()->contains('district', trim($district_name))) {
            return ['error' => 'district not found'];
        }
        return DB::table('uganda_regions')->select(DB::raw(self::$dbColumns))->where('district', 'like', trim($district_name))->get()->all();

    }
}
