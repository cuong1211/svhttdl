<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;
use Tonysm\RichTextLaravel\Models\RichText;

class Opinion extends Model
{
    use HasFactory;
    use HasRichText;
    use SoftDeletes;
    protected $table = 'opinions';
    protected $guarded = [];

    public function document_opinion()
    {
        return $this->hasMany(Document_Opinion::class, 'id', 'document_id');
    }

    protected $richTextAttributes = [
        'content',
    ];

    protected $casts = [
        'content' => AsRichTextContent::class,
    ];
    protected static function booted()
    {
        static::deleting(function ($opinion) {
            $opinion->deleteRichText();
        });
    }

    public function deleteRichText()
    {
        foreach ($this->richTextAttributes as $attribute) {
            $richText = $this->getRichText($attribute);
            if ($richText) {
                $richText->delete();
            }
        }
    }

    public function getRichText($attribute)
    {
        return RichText::where('record_type', get_class($this))
            ->where('record_id', $this->id)
            ->where('field', $attribute)
            ->first();
    }
    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }

    public function getDeletedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value));
    }

    public function getDeletedAtViAttribute()
    {
        return date('d/m/Y H:i', strtotime($this->deleted_at));
    }
}
