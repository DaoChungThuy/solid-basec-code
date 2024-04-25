<?php

namespace App\Interfaces\User;

use App\Interfaces\CrudRepositoryInterface;

interface UserRepositoryInterface extends CrudRepositoryInterface
{
    public function findByEmail($email);

    public function findBydata($colum, $data, $operator = '=');

    public function getRole($id);

}
