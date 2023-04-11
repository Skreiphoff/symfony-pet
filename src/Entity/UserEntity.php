<?php

namespace App\Entity;

use App\Service\Database\AbstractModel;

/**
 * @property int $id
 * @property bool|null $is_bot
 * @property int $telegram_user_id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $username
 * @property string|null $language_code
 * @property bool|null $is_premium
 * @property bool|null $added_to_attachment_menu
 * @property bool|null $can_join_groups
 * @property bool|null $can_read_all_group_messages
 * @property bool|null $supports_inline_queries
 * @property int|null $created_at
 * @property string|null
 */
class UserEntity extends AbstractModel
{
    protected string $table_name = 'users';

    protected array $allowed_attributes = [
        'id',
        'is_bot',
        'telegram_user_id',
        'first_name',
        'last_name',
        'username',
        'language_code',
        'is_premium',
        'added_to_attachment_menu',
        'can_join_groups',
        'can_read_all_group_messages',
        'supports_inline_queries',
        'created_at',
        'tmp_link'
    ];
}