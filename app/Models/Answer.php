<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Tonysm\RichTextLaravel\Casts\AsRichTextContent;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
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