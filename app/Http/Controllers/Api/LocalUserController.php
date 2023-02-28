<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Resources\LocalUserResource;
use App\Models\LocalUser;
use App\Services\LocalUserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Laravel\Octane\Facades\Octane;

class LocalUserController extends Controller
{
    public function __construct(private LocalUserService $service)
    {
    }

    public function create(CreateRequest $request): LocalUserResource
    {
        $data = $request->validated();

        $user = $this->service->create($data);

        return new LocalUserResource($user);
    }

    public function edit(LocalUser $user, EditRequest $request): LocalUserResource
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

    public function about(LocalUser $user): LocalUserResource
    {
        return new LocalUserResource($user);
    }

    public function list(): AnonymousResourceCollection
    {
        // For swoole with parallel programming

//        $firstPart = fn() => LocalUser::query()->skip(0)->take(2)->get()->collect();
//        $lastPart = fn() => LocalUser::query()->skip(2)->take(2)->get()->collect();
//
//        [$firstUsers, $lastUsers] = Octane::concurrently([
//            $firstPart,
//            $lastPart
//        ], 9000);
//
//        $users = $firstUsers->merge($lastUsers);

        // For roadrunner

        $users = LocalUser::all();

        return LocalUserResource::collection($users);
    }
}
