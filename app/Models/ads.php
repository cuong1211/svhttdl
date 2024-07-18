<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class ads extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $fillable = ['title', 'order', 'url'];

    protected $table = 'ads';
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lg')
            ->width(1020)
            ->height(603)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('ads_image');

        $this->addMediaConversion('md')
            ->width(541)
            ->height(320)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('ads_image');

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(276)
            ->sharpen(10)
            ->format('jpg')
            ->performOnCollections('ads_image');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('ads_image')
            ->singleFile()
            ->useDisk('custom');
    }
}
