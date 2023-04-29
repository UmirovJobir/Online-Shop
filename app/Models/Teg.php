<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teg extends Model
{
    use HasFactory;

    protected $table = 'tegs';
    protected $guarded = false;
}
