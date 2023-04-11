<?php

namespace App\Service\Database;

class Result
{
    public function __construct(private readonly \PgSql\Result $result, private AbstractModel $model)
    {
    }

    public function fetchAll(): array|AbstractModel
    {

        $models = [];
        foreach (pg_fetch_all($this->result) as $row) {
            $model = new $this->model;
            $models[] = $model->setAttributes($row);
        }

        return $models;
    }

    public function fetchFromFirstRow()
    {
        $result = pg_fetch_row($this->result, mode:PGSQL_ASSOC);
        $this->model->setAttributes($result);
        return $this->model;
    }
}