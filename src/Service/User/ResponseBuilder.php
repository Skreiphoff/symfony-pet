<?php

namespace App\Service\User;

use App\Dto\Response\UsersResponse;
use App\Entity\UserEntity;

class ResponseBuilder
{
    /**
     * @param UserEntity[] $users
     * @return UsersResponse[]
     */
    public function build(array $users): array
    {
        $responses = [];
        foreach ($users as $model) {
            $user_response = new UsersResponse();
            $user_response->id = $model->id;
            $user_response->is_bot = $model->is_bot;
            $user_response->telegram_user_id = $model->telegram_user_id;
            $user_response->first_name = $model->first_name;
            $user_response->last_name = $model->last_name;
            $user_response->username = $model->username;
            $user_response->language_code = $model->language_code;
            $user_response->is_premium = $model->is_premium;
            $user_response->added_to_attachment_menu = $model->added_to_attachment_menu;
            $user_response->can_join_groups = $model->can_join_groups;
            $user_response->can_read_all_group_messages = $model->can_read_all_group_messages;
            $user_response->supports_inline_queries = $model->supports_inline_queries;
            $user_response->created_at = date("Y-m-d H:i:s",$model->created_at);

            $responses[] = $user_response;
        }

        return $responses;
    }
}