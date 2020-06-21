<?php

namespace PaulhenriL\LaravelTaskRunner\Tests\Fakes;

use Illuminate\Console\Command;

class TaskBreak
{
    public function __invoke(Command $command)
    {
        return false;
    }
}
