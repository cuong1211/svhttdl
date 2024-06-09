<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Staff extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $table = 'staff';

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('lg')
            ->width(1020)
            ->height(603)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('staff_image');

        $this->addMediaConversion('md')
            ->width(541)
            ->height(320)
            ->sharpen(5)
            ->format('jpg')
            ->performOnCollections('staff_image');

        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(276)
            ->sharpen(10)
            ->format('jpg')
            ->performOnCollections('staff_image');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('staff_image')
            ->singleFile()
            ->useDisk('staff');
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d.m.Y h:i'),
        );
    }

    protected function createdAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d.m.Y h:i'),
        );
    }
}
