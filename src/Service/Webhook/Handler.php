<?php

namespace App\Service\Webhook;

use App\Service\Webhook\Factory\CommandFactory;

class Handler
{
    public function handle($message): void
    {
        if (!isset($message['entities']) || $message['entities'][0]['type'] !== 'bot_command') {
            return;
        }

        $command = (new CommandFactory($message['text']))->getCommand();
        $command->process($message);
    }
}