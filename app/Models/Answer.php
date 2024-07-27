<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
use Tonysm\RichTextLaravel\Models\RichText;
use Illuminate\Database\Eloquent\SoftDeletes;


class Answer extends Model
{
    use HasFactory;
    use HasRichText;
    use SoftDeletes;

    protected $table = 'answers';

    protected $guarded = [];

    protected $richTextAttributes = [
        'content',
    ];

    protected $casts = [
        'content' => AsRichTextContent::class,
    ];
    protected static function booted()
    {
        static::deleting(function ($answer) {
            $answer->deleteRichText();
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
    protected function createdAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d/m/Y h:i'),
        );
    }

    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
