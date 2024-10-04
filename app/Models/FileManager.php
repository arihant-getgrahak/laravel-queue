<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FileManager extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        "image"
    ];
}
