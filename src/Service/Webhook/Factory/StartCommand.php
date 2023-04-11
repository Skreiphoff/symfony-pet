<?php

namespace App\Service\Webhook\Factory;

use App\Repository\UserRepository;

class StartCommand extends AbstractCommand
{

    public function process(array $data)
    {

        $user_data = $data['from'];
        $user_data['telegram_user_id'] = $user_data['id'];
        unset($user_data['id']);

        (new UserRepository())->saveOne($user_data);
    }
}