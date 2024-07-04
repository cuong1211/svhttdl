<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;
    protected $guarded = [];

    protected $table = 'document';
    protected $casts = [
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];
    public function signers()
    {
        return $this->belongsTo(Signer::class, 'tag_id');
    }
    public function types()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('')
            ->sharpen(5)
            ->format('pdf')
            ->performOnCollections('document_file');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('document_file')
            ->singleFile()
            ->useDisk('document');
    }

    public function getPublishedAtViAttribute()
    {
        return ucfirst(Carbon::parse($this->published_at)->translatedFormat('l, d/m/Y'));
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d.m.Y h:i'),
        );
    }

    protected function publishedPostDate(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->published_at->translatedFormat('d/m/Y'),
        );
    }

    protected function publishedPostDateThumb(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->published_at->diffForHumans(),
        );
    }

    public function getPublishedDateAttribute()
    {
        return Carbon::parse($this->published_at)->format('M d, Y H:i');
    }

    public function getPublishedDateSearchAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => \Carbon\Carbon::parse($value)->format('Y-m-d'),
        );
    }
}
