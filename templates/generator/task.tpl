<?php
declare(strict_types = 1);
namespace %namespace%\Task;

use Origin\Schedule\Task;
use Origin\Schedule\Schedule;

class %class%Task extends Task
{
    protected $name = '%custom%';
    protected $description = '';

    protected function startup(): void
    {
    }

    protected function handle(Schedule $schedule): void
    {
        $event = $schedule->command('ls -la')
            ->everyMinute();
    }

    protected function shutdown(): void
    {
    }
}