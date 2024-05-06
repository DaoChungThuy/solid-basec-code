<?php

namespace App\Http\Controllers\Api\ToDo;

use App\Http\Controllers\Controller;
use App\Services\ToDo\FindToDoService;
use Illuminate\Http\Request;
use App\Services\ToDo\CreateToDoService;
use App\Services\ToDo\UpdateToDoService;
use App\Services\ToDo\FindByUserService;
use App\Services\ToDo\DeleteToDoService;
use App\Services\ToDo\FindByRequestService;
use App\Services\ToDoCategory\GetCategoryService;
use App\Http\Requests\ToDo\CreateToDoRequest;
use App\Http\Requests\ToDo\UpdateToDoRequest;



class ToDoController extends Controller
{
    public function index(Request $request)
    {
        $toDo = resolve(FindByRequestService::class)->setParams($request->all())->handle();

        if (!$toDo) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $toDo,
            'message' => __('message.success'),
        ]);

    }

    public function getCategory(Request $request)
    {
        $category = resolve(GetCategoryService::class)->handle();
        if (!$category) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $category,
            'message' => __('message.success'),
        ]);
    }

    public function store(CreateToDoRequest $request)
    {
        $toDo = resolve(CreateToDoService::class)->setParams($request->all())->handle();

        if (!$toDo) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $toDo,
            'message' => __('message.success'),
        ]);
    }

    public function find($id)
    {
        $toDo = resolve(FindToDoService::class)->setParams($id)->handle();

        if (!$toDo) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $toDo,
            'message' => __('message.success'),
        ]);
    }

    public function findByUser()
    {
        $toDo = resolve(FindByUserService::class)->handle();

        if (!$toDo) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $toDo,
            'message' => __('message.success'),
        ]);
    }

    public function show($id)
    {

    }

    public function update(UpdateToDoRequest $request, $id)
    {
        $data = array_merge($request->validated(), ['id' => $id]);

        $toDo = resolve(UpdateToDoService::class)->setParams($data)->handle();

        if (!$toDo) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $data,
            'message' => __('message.success'),
        ]);
    }

    public function destroy($id)
    {
        $toDo = resolve(DeleteToDoService::class)->setParams($id)->handle();
        if (!$toDo) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'message' => __('message.success'),
        ]);
    }

}
