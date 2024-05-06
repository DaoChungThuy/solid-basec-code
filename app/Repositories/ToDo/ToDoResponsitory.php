<?php

namespace App\Repositories\ToDo;

use App\Interfaces\ToDo\ToDoRepositoryInterface;
use App\Models\ToDo;
use App\Repositories\BaseRepository;

class ToDoResponsitory extends BaseRepository implements ToDoRepositoryInterface
{
    public function __construct(ToDo $toDo)
    {
        $this->model = $toDo;
    }

    public function findBydata($colum, $data, $operator = '=')
    {
        return $this->model->where($colum, $operator, $data)->orderBy('start_time', 'ASC')->get();
    }

    public function getByQuery($search = null, $where = [], $orderBy = [])
    {
        $result = $this->model;
        $dataSet = $result->where(function ($query) use ($search) {
            if (!empty ($search)) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            }
        })
            ->where($where)
            ->when(!empty($orderBy), function ($query) use ($orderBy) {
                $pairs = array_chunk($orderBy, 2);

                foreach ($pairs as $pair) {
                    $query->orderBy(...$pair);
                }
            })
            ->get();

        return $dataSet;
    }

}
