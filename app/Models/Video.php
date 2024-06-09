<?php

namespace App\Models;

use App\Enums\VideoSourceEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'source', 'album_id', 'video_id'];

    protected $table = 'videos';

    protected $casts = [
        'source' => VideoSourceEnum::class,
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    protected function createddAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d.m.Y h:i'),
        );
    }

    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d.m.Y h:i'),
        );
    }
}
