<?php

namespace PaulhenriL\LaravelTaskRunner;

use Symfony\Component\Console\Output\OutputInterface;

trait CanRunTasks
{
    /**
     * The original OutputInterface instance.
     *
     * @var OutputInterface|null
     */
    protected $originalOutput;

    /**
     * Run the given tasks with the given arguments.
     */
    protected function runTasks(array $tasks, ...$args): void
    {
        while ($task = array_shift($tasks)) {
            $this->runTask(
                $this->getLaravel()->make($task), $args
            );

            if (count($tasks)) {
                $this->line('');
            }
        }
    }

    /**
     * Run the given task.
     */
    protected function runTask($task, array $args): void
    {
        $this->output->writeln('[' . get_class($task) . ']');

        $output = $this->spyOutput();
        $task->run(...$args);
        $this->resetOutput();

        if (!$output->hasBeenWritten()) {
            $this->info(class_basename($task) . ' Complete.');
        }
    }

    /**
     * Spy the output.
     */
    protected function spyOutput(): SpyOutput
    {
        if (!$this->originalOutput) {
            $this->originalOutput = $this->output;
        }

        $this->output = new SpyOutput($this->originalOutput);

        return $this->output;
    }

    /**
     * Reset the output
     */
    protected function resetOutput()
    {
        $this->setOutput($this->originalOutput);
    }
}
