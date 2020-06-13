<?php

namespace PaulhenriL\LaravelTaskRunner\Tests\Feature;

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
            ->expectsOutput('')
            ->expectsOutput('[' . TaskWithOutput::class . ']')
            ->expectsOutput('Hello.');
    }
}
