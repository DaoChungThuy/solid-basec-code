<?php

namespace App\Services\ToDo;

use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Interfaces\ToDo\ToDoRepositoryInterface;

class FindByUserService extends BaseService
{
    protected $toDoRespository;

    public function __construct(ToDoRepositoryInterface $toDoRespository)
    {
        $this->toDoRespository = $toDoRespository;
    }

    public function handle()
    {
        try {
            $this->data = auth()->user()->id;
            $toDoList = $this->toDoRespository->findBydata('user_id', $this->data);

            return $toDoList;
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}