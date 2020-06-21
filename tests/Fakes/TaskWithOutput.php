<?php

namespace PaulhenriL\LaravelTaskRunner\Tests\Fakes;

use Illuminate\Console\Command;

class TaskWithOutput
{
    public function __invoke(Command $command)
    {
        $command->info('Hello.');
    }
}
