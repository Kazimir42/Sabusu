<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, HasMedia;

    protected $fillable = [
        'title',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            $category->medias->each(function ($media) {
                $media->delete();
            });
        });
    }

    public function suppliers(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }

    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function user() : belongsTo
    {
        return $this->belongsTo(User::class);
    }

}
