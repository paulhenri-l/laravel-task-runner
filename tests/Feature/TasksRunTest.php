<?php

namespace PaulhenriL\LaravelTaskRunner\Tests\Feature;

use PaulhenriL\LaravelTaskRunner\Tests\Fakes\TaskBreak;
use PaulhenriL\LaravelTaskRunner\Tests\Fakes\TaskWithoutOutput;
use PaulhenriL\LaravelTaskRunner\Tests\Fakes\TaskWithOutput;
use PaulhenriL\LaravelTaskRunner\Tests\TestCase;

class TasksRunTest extends TestCase
{
    public function test_task_run()
    {
        $this->artisan('fake-command')
            ->expectsOutput('[' . TaskWithoutOutput::class . ']')
            ->expectsOutput('TaskWithoutOutput Complete.')
//            ->expectsOutput('')
            ->expectsOutput('[' . TaskWithOutput::class . ']')
            ->expectsOutput('Hello.');
    }

    public function test_task_stop_early()
    {
        $this->artisan('fake-command-two')
            ->expectsOutput('[' . TaskWithoutOutput::class . ']')
            ->expectsOutput('TaskWithoutOutput Complete.')
//            ->expectsOutput('')
            ->expectsOutput('[' . TaskBreak::class . ']')
            ->expectsOutput('TaskBreak Complete.');

        // We cannot assert that the third task has not been executed but the
        // coverage report will show that the correct code path has been taken.
    }
}
