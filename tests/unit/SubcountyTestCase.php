<?php

namespace JaymesKat\UgGeog\Tests\Unit;

use JaymesKat\UgGeog\Tests\TestCase;
use JaymesKat\UgGeog\Models\Subcounty;

class SubcountyTestCase extends TestCase
{

    public function test_get_all_subcounties()
    {
        $subcountyArray = Subcounty::list();
        $this->assertNotEmpty($subcountyArray);
    }

    public function test_get_single_subcounty(){
        $subcounty = Subcounty::get('Bihanga');
        $this->assertEquals('Bihanga', $subcounty->subcounty_name);
    }

    public function test_get_subcounties_in_district(){
        $subcounties = Subcounty::inDistrict('Kampala');
        $this->assertTrue(is_array($subcounties));
        $this->assertEquals('Kampala', $subcounties[0]->district_name);
    }
}
