<?php

namespace App\Repositories\Deadline;

use App\Repositories\RepositoryEloquent;
use App\Models\Deadline;
use App\Repositories\Deadline\DeadlineRepositoryInterface;

class DeadlineRepositoryEloquent extends RepositoryEloquent implements DeadlineRepositoryInterface
{
  public function getModel()
    {
        return Deadline::class;
    }
}