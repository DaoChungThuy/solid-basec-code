<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\CreateUserService;
use App\Services\User\GetUserService;
use App\Services\User\UpdateUserService;
use App\Services\User\DeleteUserService;
use App\Http\Requests\CreateUpdate\CreateRequest;
use App\Http\Requests\CreateUpdate\UpdateRequest;
use App\Services\User\FindUserService;

class UserController extends Controller
{
    public function store(CreateRequest $request)
    {
        $user = resolve(CreateUserService::class)->setParams($request->validated())->handle();

        if (!$user) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $user,
            'message' => __('message.success'),
        ]);
    }

    public function index()
    {
        $user = resolve(GetUserService::class)->handle();

        if (!$user) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $user,
            'message' => __('message.success'),
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = array_merge($request->validated(), ['id' => $id]);

        $user = resolve(UpdateUserService::class)->setParams($data)->handle();

        if (!$user) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $data,
            'message' => __('message.success'),
        ]);
    }

    public function destroy($id)
    {
        $user = resolve(DeleteUserService::class)->setParams($id)->handle();

        if (!$user) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $user,
            'message' => __('message.success'),
        ]);
    }

    public function show($id)
    {
        $user = resolve(FindUserService::class)->setParams($id)->handle();

        if (empty($user)) {
            return $this->responseErrors(__('message.errors'));
        }

        return $this->responseSuccess([
            'data' => $user,
            'message' => __('message.success'),
        ]);
    }
}
