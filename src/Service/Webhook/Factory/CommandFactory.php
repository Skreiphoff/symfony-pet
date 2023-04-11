<?php

namespace App\Service\Webhook\Factory;

class CommandFactory
{
    private AbstractCommand $command;

    public function __construct(string $command)
    {
        return match ($command) {
            '/start' => $this->command = new StartCommand()
        };
    }

    public function getCommand(): AbstractCommand
    {
        return $this->command;
    }
}