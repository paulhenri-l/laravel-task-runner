# LaravelTaskRunner

![Tests](https://github.com/paulhenri-l/laravel-task-runner/workflows/Tests/badge.svg)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)


This tool will help you run a defined set of tasks in your commands. It's useful 
in cases where your commands needs to consequently run different operations.

This tool is used inside both 
[LaravelEngine](https://github.com/paulhenri-l/laravel-engine) and the
[PHL Console](https://github.com/paulhenri-l/console).

## Example

```shell script
php artisan my-command

[Some\Namespace\MyFirstTask]
Hello from MyFirstTask.

[Some\Namespace\MySecondTask]
MySecondTask Complete.

Installation done 🎉
```

## Installation

```shell script
composer require paulhenri-l/laravel-task-runner
```

## Usage

In order to use the TaskRunner you need to add the `CanRunTasks` trait to your
command and call the `runTasks` method.

The only argument is the array of tasks you want to run. A task is an invokable
class. You can either pass instances of tasks or their classname.

*If you pass in a classname the task will be resolved through laravel's
container, so you can type hint any dependency you may need in your task's
constructor.*

### Use the trait

```php
<?php

class FakeCommand extends Illuminate\Console\Command
{
    use PaulhenriL\LaravelTaskRunner\CanRunTasks;

    protected $signature = 'my-command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->runTasks([
            MyFirstTask::class,
            new MySecondTask()
        ]);

        $this->info('Installation done 🎉');
    }
}
```

### Writing a task

```php
<?php

use Illuminate\Console\Command;
use PaulhenriL\LaravelTaskRunner\TaskInterface;

class MyFirstTask implements TaskInterface
{
    public function __construct(SomeDependency $someDependency)
    {
        //
    }

    public function __invoke(Command $command)
    {
        $command->info('Hello from MyFirstTask.');
    }
}
```

### Stop early

If you want to stop early you only need to return false from your task.


```php
<?php

use Illuminate\Console\Command;
use PaulhenriL\LaravelTaskRunner\TaskInterface;

class SomeTask implements TaskInterface
{
    public function __invoke(Command $command)
    {
        if ($thereIsAnError) {
            return false;
        }
    }
}
```
