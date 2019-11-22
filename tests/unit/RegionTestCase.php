<?php

namespace JaymesKat\UgGeog\Tests\Unit;

use JaymesKat\UgGeog\Tests\TestCase;
use JaymesKat\UgGeog\Models\Region;

class RegionTestCase extends TestCase
{

    public function test_get_all_regions()
    {
        $regionsArray = Region::list();
        $this->assertNotNull($regionsArray);
        $this->assertEquals(4, count($regionsArray));
    }

    public function test_get_single_region(){
        $region = Region::get('Central');
        $this->assertEquals('Central', $region['info']->region);
        $this->assertNotEmpty($region['districts']);
    }
}
