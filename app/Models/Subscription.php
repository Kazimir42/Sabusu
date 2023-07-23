<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'frequency',
        'cost',
        'user_id'
    ];

    public function subscriptions() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
