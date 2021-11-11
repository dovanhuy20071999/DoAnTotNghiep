<?php

namespace App\Repositories\Order;

use App\Repositories\RepositoryEloquent;
use App\Models\Order;
use App\Repositories\Order\OrderRepositoryInterface;

class OrderRepositoryEloquent extends RepositoryEloquent implements OrderRepositoryInterface
{
  public function getModel()
    {
        return Order::class;
    }
}