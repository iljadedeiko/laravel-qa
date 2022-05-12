<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgLanguages extends Model
{
    use HasFactory;

    protected $fillable = ['prog_language'];
    public $timestamps = false;
}
