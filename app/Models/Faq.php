<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;

class Faq extends Model
{
    use HasFactory;
    use HasRichText;

    protected $table = 'faqs';

    protected $guarded = [];

    protected $richTextAttributes = [
        'question',
    ];

    protected $casts = [
        'question' => AsRichTextContent::class,
    ];

    protected function createdAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d.m.Y h:i'),
        );
    }
}
