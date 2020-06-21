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
    protected function runTasks(array $tasks): bool
    {
        $tasks = $this->prepareTasks($tasks);

        while ($task = array_shift($tasks)) {
            $result = $this->runTask($task);

            if (!$result) {
                return false;
            }

            if (count($tasks)) {
                $this->line('');
            }
        }

        return true;
    }

    /**
     * Run the given task.
     */
    protected function runTask($task): bool
    {
        $this->output->writeln('[' . get_class($task) . ']');

        $output = $this->spyOutput();
        $result = $task($this);
        $this->resetOutput();

        if (!$output->hasBeenWritten()) {
            $this->info(class_basename($task) . ' Complete.');
        }

        return is_null($result) ? true : $result;
    }

    /**
     * Prepare the tasks.
     */
    protected function prepareTasks(array $tasks): array
    {
        foreach ($tasks as &$task) {
            if (is_string($task)) {
                $task = $this->getLaravel()->make($task);
            }
        }

        return $tasks;
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
