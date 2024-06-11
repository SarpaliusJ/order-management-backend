<?php

namespace App\Services\Order;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function list()
    {
        return Auth::user()->orders()->orderBy('created_at', 'desc')->get();
    }

    public function create(array $data): void
    {
        foreach ($data as $item) {
            Order::create([
               Order::COL_USER_ID => Auth::id(),
               Order::COL_ITEM => $item[Order::COL_ITEM],
               Order::COL_QUANTITY => $item[Order::COL_QUANTITY],
               Order::COL_PRICE => $item[Order::COL_PRICE],
            ]);
        }
    }

    public function update(Order $order, array $data): void
    {
        $order->update($data);
    }
}
