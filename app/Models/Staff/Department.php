<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Department extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'departments';

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    protected function updatedAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->updated_at)->format('d/m/Y h:i'),
        );
    }

    protected function createdAtVi(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->created_at)->format('d/m/Y h:i'),
        );
    }
}
