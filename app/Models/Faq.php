<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tonysm\RichTextLaravel\Models\RichText;

class Faq extends Model
{
    use HasFactory;
    use HasRichText;
    use SoftDeletes;
    protected $table = 'faqs';

    protected $guarded = [];

    protected $richTextAttributes = [
        'question',
    ];
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    protected static function booted()
    {
        static::deleting(function ($faq) {
            $faq->deleteRichText();
            if($faq->answers){
                $faq->answers->each(function ($answer) {
                    $answer->deleteRichText();
                    $answer->delete();
                });
            }
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
    protected $casts = [
        'question' => AsRichTextContent::class,
    ];

    protected function createdAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d/m/Y h:i'),
        );
    }
}
