<?php

namespace PaulhenriL\LaravelTaskRunner\Tests\Fakes;


use Illuminate\Console\Command;
use PaulhenriL\LaravelTaskRunner\CanRunTasks;

class FakeCommand extends Command
{
    use CanRunTasks;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake-command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->runTasks([
            new TaskWithoutOutput,
            TaskWithOutput::class
        ]);
    }
}

