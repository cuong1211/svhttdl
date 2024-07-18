<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;

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
