<?php

namespace PaulhenriL\LaravelTaskRunner\Tests\Fakes;

use Illuminate\Console\Command;

class TaskWithoutOutput
{
    public function run(Command $command)
    {
        //
    }
}
