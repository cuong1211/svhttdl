<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document_Opinion extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;
    use HasRichText;
    protected $table = 'document_opinions';
    protected $guarded = [];

    protected $richTextAttributes = [
        'content',
    ];

    protected $casts = [
        'content' => AsRichTextContent::class,
    ];
    public function opinion()
    {
        return $this->belongsTo(Opinion::class, 'document_id', 'id');
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
            ->useDisk('document_opinion');
    }

  
    protected function createdAtVi(): Attribute
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
    protected function startAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->start_date)->format('d/m/Y'),
        );
    }
    protected function endAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->end_date)->format('d/m/Y'),
        );
    }
}
