<?php

namespace PaulhenriL\LaravelTaskRunner\Tests\Fakes;


use Illuminate\Console\Command;
use PaulhenriL\LaravelTaskRunner\CanRunTasks;

class FakeCommandTwo extends Command
{
    use CanRunTasks;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake-command-two';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->runTasks([
            TaskWithoutOutput::class,
            TaskBreak::class,
            TaskWithOutput::class
        ], $this);
    }
}

