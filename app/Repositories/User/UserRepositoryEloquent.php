<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryEloquent;
use App\Models\User;

class UserRepositoryEloquent extends RepositoryEloquent implements UserRepositoryInterface
{
  public function getModel()
    {
        return User::class;
    }

    public function getInfoUserByEmail($email)
    {
        $result = $this->_model
            ->where('users.email', $email)
            // ->joinActive()
            // ->selectActive()
            ->get();
        

        return $result;
    }
}