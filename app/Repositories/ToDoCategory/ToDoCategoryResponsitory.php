<?php

namespace App\Repositories\ToDoCategory;

use App\Interfaces\ToDoCategory\ToDoCategoryRespositoryInterface;
use App\Models\JobCategory;
use App\Repositories\BaseRepository;

class ToDoCategoryResponsitory extends BaseRepository implements ToDoCategoryRespositoryInterface
{
    public function __construct(JobCategory $category)
    {
        $this->model = $category;
    }
}