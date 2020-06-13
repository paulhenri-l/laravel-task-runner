<?php

namespace PaulhenriL\LaravelTaskRunner\Tests\Fakes;

use Illuminate\Console\Command;

class TaskWithOutput
{
    public function run(Command $command)
    {
        $command->info('Hello.');
    }
}
