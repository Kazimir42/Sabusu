<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, HasMedia;

    protected $fillable = [
        'title',
    ];

    public function suppliers() : HasMany
    {
        return $this->hasMany(Supplier::class);
    }

    public function category() : HasMany
    {
        return $this->hasMany(Category::class);
    }

}
