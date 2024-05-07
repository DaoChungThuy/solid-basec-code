<?php

namespace App\Services\ToDo;

use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Interfaces\ToDo\ToDoRepositoryInterface;

class UpdateToDoService extends BaseService
{
    protected $toDoRespository;

    public function __construct(ToDoRepositoryInterface $toDoRespository)
    {
        $this->toDoRespository = $toDoRespository;
    }

    public function handle()
    {
        try {
            $this->toDoRespository->update($this->data, $this->data['id']);

            return true;
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}