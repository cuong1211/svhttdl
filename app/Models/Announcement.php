<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'announcements';

    protected $casts = [
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function scopePublished($query)
    {
        return $query->whereDate('published_at', '<=', now());
    }

    public function getPublishedAtViAttribute()
    {
        return ucfirst(Carbon::parse($this->published_at)->translatedFormat('d/m/Y h:i'));
    }
    protected function publishedPostDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->published_at->translatedFormat('d/m/Y'),
        );
    }
    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d/m/Y h:i'),
        );
    }

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Carbon::parse($value)->format('Y-m-d H:i:s'),
        );
    }
}
