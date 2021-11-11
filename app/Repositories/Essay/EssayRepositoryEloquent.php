<?php

namespace App\Repositories\Essay;

use App\Repositories\RepositoryEloquent;
use App\Models\Essay;
use App\Repositories\Essay\EssayRepositoryInterface;

class EssayRepositoryEloquent extends RepositoryEloquent implements EssayRepositoryInterface
{
  public function getModel()
    {
        return Essay::class;
    }
}