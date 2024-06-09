<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Document extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $table = 'document';

    public function signers()
    {
        return $this->belongsTo(Signer::class, 'signer_id');
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
