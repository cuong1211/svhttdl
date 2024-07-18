<?php

namespace App\Models;

use App\Enums\VideoSourceEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $fillable = ['name', 'source', 'album_id', 'video_id', 'is_active'];

    protected $table = 'videos';

    protected $casts = [
        'source' => VideoSourceEnum::class,
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lg')
            ->width(1020)
            ->height(603)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('thumbnail_video');

        $this->addMediaConversion('md')
            ->width(541)
            ->height(320)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('thumbnail_video');

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(276)
            ->sharpen(10)
            ->format('jpg')
            ->performOnCollections('thumbnail_video');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail_video')
            ->singleFile()
            ->useDisk('album');
    }
    protected function createddAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d/m/Y h:i'),
        );
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d/m/Y h:i'),
        );
    }
}
