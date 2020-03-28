<?php


namespace Muhsenmaqsudi\Press\Tests;


use Muhsenmaqsudi\Press\PressBaseServiceProvider;
use Orchestra\Testbench\TestCase as TestCaseBase;

class TestCase extends TestCaseBase
{
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
}