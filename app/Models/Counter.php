<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected array $dates = ['date'];

    protected $fillable = ['ip', 'user_agent', 'time', 'date'];
}
