<?php

namespace App\Services;

use App\Models\LocalUser;

class LocalUserService
{
    public function create(array $data): LocalUser
    {
        $localUser = new LocalUser($data);
        $localUser->save();

        return $localUser;
    }

    public function update(LocalUser $localUser, array $data): void
    {
        $localUser->fill($data);

        $localUser->save();
    }

    public function delete(LocalUser $localUser): void
    {
        $localUser->delete();
    }
}
