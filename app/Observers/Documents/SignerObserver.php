<?php

namespace App\Observers\Documents;

use App\Models\Document\Signer;
use Illuminate\Support\Str;

class SignerObserver
{
    public function saving(Signer $signer)
    {
        $signer->name = Str::ucfirst($signer->name);
        $signer->slug = Str::slug($signer->name);
    }
}
