<?php

namespace App\Service\Database;


use Monolog\Logger;
use PgSql\Connection;
//TODO: Фигово по SOLID надо думать как изменить, пока так будет
class Db
{
    private static Db $instance;
    private Connection $db_connection;

    /**
     * @throws DatabaseException
     */
    private function __construct()
    {
    }

    protected function __clone()
    {
        throw new \Exception("Cannot clone DB");
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize DB");
    }

    /**
     * Метод, используемый для получения экземпляра Одиночки.
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * @throws DatabaseException
     */
    public static function getDbConnection()
    {
        $db = self::getInstance();
        try {
            $db->db_connection = pg_connect(
                "host=". $_ENV['DB_HOST'].
                " dbname=" . $_ENV['DATABASE'].
                " user=" . $_ENV["DB_USER"].
                " password=" . $_ENV['DB_PASSWORD']
            );
        } catch (\Exception $exception) {
            (new Logger('errors'))->error($exception->getMessage());
            throw new DatabaseException('ошибка при открытии подключения');
        }

        return $db->db_connection;
    }
}