<?php

namespace App\Service\Database;

abstract class AbstractModel
{
    protected string $table_name;
    protected array $allowed_attributes;

    /**
     * @throws ModelException
     */
    public function setAttributes(array $values): self
    {
        $attributes = $this->getAttributes();
        foreach ($values as $name => $value) {
            if (in_array($name, $attributes)) {
                $this->$name = $value;
            }
        }

        return $this;
    }

    /**
     * @throws ModelException
     */
    public function getTableName(): string
    {
        if (!$this->table_name) {
            throw new ModelException('Не определено название таблицы');
        }
        return $this->table_name;
    }

    public function getAttributes(): array
    {
        if (!$this->allowed_attributes) {
            throw new ModelException('Не определено название таблицы');
        }

        return $this->allowed_attributes;
    }

    public function sqlFindAll(string $query): Result
    {
        $conn = Db::getDbConnection();
        $result = pg_query($conn, $query);
        return new Result($result, $this);
    }

    public function findAll(array $condition = [], array $params = []): Result
    {
        return $this->sqlFindAll($this->getQueryString($condition, $params));
    }

    private function getQueryString(array $condition = [], array $params = [])
    {
        $fields = $params['select'] ?? implode(',',$this->getAttributes());
        $where = $this->buildWhere($condition);
        $join = $params['join'] ?? '';
        $limit = $params['limit'] ?? '';
        $offset = $params['offset'] ?? '';
        $query = "SELECT $fields FROM {$this->getTableName()} 
$join
$where
$limit
$offset
";
        return trim($query);
    }

    private function buildWhere(array $condition):string
    {
        if (!$condition) {
            return '';
        }

        $conditions = [];
        foreach ($condition as $key => $value) {
            $equals = is_array($value) ? "IN (" . implode(',', $value) . ")" : "=";
            $conditions[] = "$key $equals";
        }
        return implode(' AND ', $conditions);
    }

    /**
     * @throws ModelException
     * @throws DatabaseException
     */
    public function save(): bool
    {
        $db_connection = Db::getDbConnection();
        $values = [];
        foreach ($this as $key => $item) {
            if (in_array($key, $this->getAttributes())) {
                $values[$key] = $item;
            }
        }
        try {
            pg_insert($db_connection, $this->getTableName(), $values);
            return true;
        } catch (\Exception $exception) {
            throw new DatabaseException($exception->getMessage());
        }
    }

}