<?php

namespace App\Service\Webhook\Factory;

use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractCommand
{
    abstract function process(array $data);
}