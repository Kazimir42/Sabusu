<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory, HasMedia;

    protected $fillable = [
        'title',
        'category_id',
        'user_id',
    ];

    public function category() : belongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function subscriptions() : hasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function user() : belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
