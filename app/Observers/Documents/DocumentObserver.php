<?php

namespace App\Observers\Documents;

use App\Models\Document\Document;
use Illuminate\Support\Str;

class DocumentObserver
{
    public function saving(Document $document)
    {
        $document->name = Str::ucfirst($document->name);
        $document->slug = Str::slug($document->name);
    }
}
