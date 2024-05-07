<?php

namespace App\Interfaces\ToDo;

use App\Interfaces\CrudRepositoryInterface;

interface ToDoRepositoryInterface extends CrudRepositoryInterface
{
    public function findBydata($colum, $data, $operator = '=');

    public function getByQuery($search, array $where, array $orderBy);

}