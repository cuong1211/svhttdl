<?php

namespace App\Observers\Documents;

use App\Models\Document\Type;
use Illuminate\Support\Str;

class TypeObserver
{
    public function saving(Type $type)
    {
        $type->name = Str::ucfirst($type->name);
        $type->slug = Str::slug($type->name);
    }
}
