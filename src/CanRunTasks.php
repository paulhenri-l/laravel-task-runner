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

        $this->indentOutput(0);
    }

    /**
     * Run the given task.
     */
    protected function runTask($task, array $args): void
    {
        $this->indentOutput(0);
        $this->output->writeln('[' . get_class($task) . ']');

        $output = $this->indentOutput(2);
        $task->run(...$args);

        if (!$output->hasBeenWritten()) {
            $this->info(class_basename($task) .' Complete.');
        }
    }

    /**
     * Switch to indented output.
     */
    protected function indentOutput(int $indent = 4): IndentedOutput
    {
        if (!$this->originalOutput) {
            $this->originalOutput = $this->output;
        }

        $this->output = new IndentedOutput($this->originalOutput, $indent);

        return $this->output;
    }
}
