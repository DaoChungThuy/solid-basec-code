<?php

namespace App\Services\ToDo;

use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Repositories\ToDo\ToDoResponsitory;
use App\Interfaces\ToDo\ToDoRepositoryInterface;

class FindToDoService extends BaseService
{
    protected $toDoRespository;

    public function __construct(ToDoRepositoryInterface $toDoRespository)
    {
        $this->toDoRespository = $toDoRespository;
    }

    public function handle()
    {
        try {

            $toDo = $this->toDoRespository->find($this->data);

            return $toDo;
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}