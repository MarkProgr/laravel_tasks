<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Resources\LocalUserResource;
use App\Models\LocalUser;
use App\Services\LocalUserService;
use Illuminate\Http\Request;

class LocalUserController extends Controller
{
    public function __construct(private LocalUserService $service)
    {
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        $localUser = $this->service->create($data);

        return new LocalUserResource($localUser);
    }

    public function edit(LocalUser $user, EditRequest $request)
    {
        $data = $request->validated();

        $this->service->update($user, $data);

        return new LocalUserResource($user);
    }

    public function delete(LocalUser $user)
    {
        $this->service->delete($user);

        return response(status: 204);
    }

    public function about(LocalUser $user)
    {
        return new LocalUserResource($user);
    }

    public function list()
    {
        $users = LocalUser::all();

        return LocalUserResource::collection($users);
    }
}
