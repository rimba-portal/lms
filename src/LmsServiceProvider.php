<?php

declare(strict_types=1);

namespace Rimba\Lms;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;
use ReflectionClass;
use Rimba\Base\Services\BitesServiceProvider;
use Rimba\Wfm\Events\WorkforceAssignmentChanged;
use Rimba\Wfm\Listeners\RecordAssignmentEvent;
use Rimba\Wfm\Services\WorkforceAssignmentService;

class LmsServiceProvider extends BitesServiceProvider
{
    protected function bootPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        if ($this->app->runningInConsole()) {
            $this->registerCommandsFromDirectory();
        }

        Event::listen(WorkforceAssignmentChanged::class, RecordAssignmentEvent::class);

    }

    protected function registerPackage(): void
    {
        $this->app->singleton(WorkforceAssignmentService::class);

    }

    /**
     * Dynamically discover and boot all commands inside the package directory.
     */
    protected function registerCommandsFromDirectory()
    {
        $commandDir = __DIR__.'/Console/Commands';
        if (! is_dir($commandDir)) {
            return;
        }

        $commands = [];
        foreach (glob($commandDir.'/*.php') as $file) {
            $className = basename($file, '.php');
            $class = 'Rimba\\Wfm\\Console\\Commands\\'.$className;
            if (class_exists($class) && is_subclass_of($class, Command::class)) {
                $reflection = new ReflectionClass($class);
                if (! $reflection->isAbstract()) {
                    $commands[] = $class;
                }
            }
        }

        if ($commands !== []) {
            $this->commands($commands);
        }
    }
}
