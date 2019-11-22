<?php

namespace JaymesKat\UgGeog\Tests\Unit;

use JaymesKat\UgGeog\Tests\TestCase;
use JaymesKat\UgGeog\Models\District;

class DistrictTestCase extends TestCase
{

    public function test_get_all_districts()
    {
        $districtArray = District::list();
        $this->assertNotEmpty($districtArray);
    }

    public function test_get_single_district(){
        $district = District::get('Kampala');
        $this->assertEquals('Kampala', $district['info']->district_name);
        $this->assertNotEmpty($district['subcounties']);
    }

    public function test_get_districts_in_region(){
        $districts = District::inRegion('Central');
        $this->assertTrue(is_array($districts));
        $this->assertNotEmpty($districts);
    }
}
