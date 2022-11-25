<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Models\LocalUser;
use App\Services\LocalUserService;
use Illuminate\Support\Facades\Storage;

class LocalUserController extends Controller
{
    public function __construct(private LocalUserService $service)
    {
    }

    public function createForm()
    {
        return view('users.create-form');
    }

    public function create(CreateRequest $request)
    {
        $file = $request->file('image_name');
        $data = $request->validated();

        if ($file) {
            $data['image_name'] = $file->hashName();

            Storage::disk('public')->put($file->hashName(), file_get_contents($file));
        }

        $localUser = $this->service->create($data);

        return redirect()->route('main');
    }

    public function list()
    {
        $users = LocalUser::all();

        return view('welcome', compact('users'));
    }

    public function editForm(LocalUser $localUser)
    {
        return view('users.edit-form', compact('localUser'));
    }

    public function edit(LocalUser $localUser, EditRequest $request)
    {
        $file = $request->file('image_name');
        $data = $request->validated();

        if ($file && $localUser->image_name) {
            $data['image_name'] = $file->hashName();
            Storage::disk('public')->put($file->hashName(), file_get_contents($file));
            Storage::disk('public')->delete($localUser->image_name);
        }

        if (!$file && $localUser->image_name) {
            $data['image_name'] = null;
            Storage::disk('public')->delete($localUser->image_name);
        }

        if ($file && !$localUser->image_name) {
            $data['image_name'] = $file->hashName();
            Storage::disk('public')->put($file->hashName(), file_get_contents($file));
        }

        $this->service->update($localUser, $data);

        return redirect()->route('main');
    }

    public function delete(LocalUser $localUser)
    {
        if ($localUser->image_name) {
            Storage::disk('public')->delete($localUser->image_name);
        }

        $this->service->delete($localUser);

        return redirect()->route('main');
    }

    public function about(LocalUser $localUser)
    {
        return view('users.about', compact('localUser'));
    }
}
