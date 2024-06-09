<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'categories';

    /*
     * -------------------------------------------------------------------------------------
     * RELATIONSHIPS
     * -------------------------------------------------------------------------------------
    */

    public function posts(): HasMany
    {
        return $this
            ->hasMany(Post::class)
            ->select('id', 'slug', 'title', 'category_id', 'published_at');
    }

    public function newsWithLimit(): HasMany
    {
        return $this
            ->hasMany(Post::class)
            ->orderBy('published_at', 'desc')
            ->limit(5);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /*
     * -------------------------------------------------------------------------------------
     * ACCESSORS & MUTATORS
     * -------------------------------------------------------------------------------------
    */

    protected function createdAtVi(): Attribute
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
