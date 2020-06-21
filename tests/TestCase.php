<?php

namespace PaulhenriL\LaravelTaskRunner\Tests;

use Illuminate\Console\Application;
use Illuminate\Console\Application as Artisan;
use PaulhenriL\LaravelTaskRunner\Tests\Fakes\FakeCommand;
use PaulhenriL\LaravelTaskRunner\Tests\Fakes\FakeCommandTwo;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Artisan::starting(function (Application $artisan) {
            $artisan->add(new FakeCommand());
            $artisan->add(new FakeCommandTwo());
        });
    }

    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);
    }
}
