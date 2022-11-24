<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Models\LocalUser;
use Illuminate\Support\Facades\Storage;

class LocalUserController extends Controller
{
    public function createForm()
    {
        return view('users.create-form');
    }

    public function createUser(CreateRequest $request)
    {
        $file = $request->file('image_name');
        $data = $request->validated();

        if ($file) {
            $data['image_name'] = $file->hashName();

            Storage::disk('public')->put($file->hashName(), file_get_contents($file));
        }

        $localUser = new LocalUser($data);
        $localUser->save();

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

    public function editUser(LocalUser $localUser, EditRequest $request)
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

        $localUser->fill($data);

        $localUser->save();

        return redirect()->route('main');
    }

    public function deleteUser(LocalUser $localUser)
    {
        $localUser->delete();

        if ($localUser->image_name) {
            Storage::disk('public')->delete($localUser->image_name);
        }

        return redirect()->route('main');
    }

    public function about(LocalUser $localUser)
    {
        return view('users.about', compact('localUser'));
    }
}
