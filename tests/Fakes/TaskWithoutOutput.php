<?php

namespace PaulhenriL\LaravelTaskRunner\Tests\Fakes;

use Illuminate\Console\Command;

class TaskWithoutOutput
{
    public function __invoke(Command $command)
    {
        //
    }
}
