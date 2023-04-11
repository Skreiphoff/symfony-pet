<?php

namespace App\Service\Webhook\Dto;

use Prugala\RequestDto\Dto\RequestDtoInterface;

class WebhookDto implements RequestDtoInterface
{
    public string $text;
    public ?EntitiesDto $entities_dto;
}