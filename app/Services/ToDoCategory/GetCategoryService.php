<?php

namespace App\Services\ToDoCategory;

use App\Repositories\ToDoCategory\ToDoCategoryResponsitory;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class GetCategoryService extends BaseService
{
    protected $categoryRepository;

    public function __construct(ToDoCategoryResponsitory $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function handle()
    {
        try {
            $this->data = auth()->user()->id;
            $category = $this->categoryRepository->all();

            return $category;
        } catch (Exception $e) {
            Log::info($e);

            return false;
        }
    }
}