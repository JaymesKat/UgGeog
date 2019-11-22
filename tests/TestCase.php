<?php
namespace JaymesKat\UgGeog\Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
    * Load Package Service Provider
    */
    protected function getPackageProviders($app)
    {
        return ['JaymesKat\UgGeog\UgGeogServiceProvider'];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../src/migrations');
        $this->artisan('migrate',['--database' => 'testbench'])->run();

        $contents = file_get_contents(__DIR__.'/../data/ug_geog_data.json');
        $regionsArr =  json_decode($contents, true);

        foreach($regionsArr as $region){
            \DB::table('uganda_regions')->insert([
                'region' => $region['Region'],
                'district' => $region['District'],
                'subcounty' => $region['Sub-county'],
                'number_of_males' => intval(str_replace(",", "", $region['Male'])),
                'number_of_females' => intval(str_replace(",", "", $region['Female'])),
                'land_area_sq_km' => $region['Land Area (Sq. Km)'],
            ]);
        }
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
