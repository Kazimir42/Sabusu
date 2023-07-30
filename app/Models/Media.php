<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    public $table = 'medias';

    protected $fillable = [
        'title',
        'path',
        'content_type',
        'hash',
        'order',
        'object_type',
        'object_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($media) {
            $media->deleteFile();
        });
    }

    public function deleteFile(): void
    {
        $path = str_replace('storage/', '', $this->path);

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function object(): MorphTo
    {
        return $this->morphTo();
    }

}
