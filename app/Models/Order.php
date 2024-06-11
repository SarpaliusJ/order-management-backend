<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    public const COL_USER_ID = 'user_id';
    public const COL_ITEM = 'item';
    public const COL_QUANTITY = 'quantity';
    public const COL_PRICE = 'price';

    protected $fillable = [
        self::COL_USER_ID,
        self::COL_ITEM,
        self::COL_QUANTITY,
        self::COL_PRICE
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
