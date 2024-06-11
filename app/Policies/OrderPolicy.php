<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Order $order): bool
    {
        if ($user->id === $order->user_id) {
            return true;
        }

        return false;
    }

    public function update(User $user, Order $order): bool
    {
        if ($user->id === $order->user_id) {
            return true;
        }

        return false;
    }

    public function delete(User $user, Order $order): bool
    {
        if ($user->id === $order->user_id) {
            return true;
        }

        return false;
    }
}
