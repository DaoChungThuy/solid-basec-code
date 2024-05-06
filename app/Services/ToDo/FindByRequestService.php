<?php

namespace App\Services\ToDo;

use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Interfaces\ToDo\ToDoRepositoryInterface;

class FindByRequestService extends BaseService
{
    protected $toDoRespository;

    public function __construct(ToDoRepositoryInterface $toDoRespository)
    {
        $this->toDoRespository = $toDoRespository;
    }

    public function handle()
    {
        try {
            $where = [['user_id', '=', auth('')->user()->id]];
            $orderBy = ['end_time', 'asc'];
            $search = null;

            if (!empty($this->data['where'])) {
                $conditions = $this->data['where'];
                array_push($where, $conditions);
            }

            if (!empty($this->data['oderBy'])) {
                $orderBy = $this->data['oderBy'];
            }

            if (!empty($this->data['search'])) {
                $search = $this->data['search'];
            }

            $toDoList = $this->toDoRespository->getByQuery($search, $where, $orderBy);

            return $toDoList;
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}