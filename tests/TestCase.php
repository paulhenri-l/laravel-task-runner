<?php

namespace PaulhenriL\LaravelTaskRunner\Tests;

use Illuminate\Console\Application;
use Illuminate\Console\Application as Artisan;
use PaulhenriL\LaravelTaskRunner\Tests\Fakes\FakeCommand;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Artisan::starting(function (Application $artisan) {
            $artisan->add(new FakeCommand());
        });
    }

    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

//        $app->make('config')->set(
//            'app.key', '00000000000000000000000000000000'
//        );
    }
}
