<?php


namespace Muhsenmaqsudi\Press\Tests;


use Muhsenmaqsudi\Press\PressBaseServiceProvider;
use Orchestra\Testbench\TestCase as TestCaseBase;

class TestCase extends TestCaseBase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__ . '/../database/factories');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            PressBaseServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ]);
    }
}