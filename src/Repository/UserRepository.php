<?php

namespace App\Repository;

use App\Entity\UserEntity;
use App\Service\Database\DatabaseException;
use App\Service\Database\ModelException;

class UserRepository
{
    public function getUserByHashLink(string $link): UserEntity
    {
        $user_entity = new UserEntity();
        return $user_entity->sqlFindAll("SELECT * FROM {$user_entity->getTableName()} WHERE tmp_link = '$link'")->fetchFromFirstRow();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return UserEntity[]
     */
    public function getUsers(int $limit = 20, int $offset = 0): array
    {
        return (new UserEntity())->findAll(params:[
            'limit' => $limit,
            'offset' => $offset
        ])->fetchAll();
    }

    /**
     * @throws ModelException
     * @throws DatabaseException
     */
    public function saveOne($user_data): void
    {
            $user = new UserEntity();
            foreach ($user_data as $key => &$item) {
                if (in_array($key, $user->getAttributes())) {
                    $user->$key = $item;
                }
            }

            $user->created_at = time();
            $user->save();
    }
}