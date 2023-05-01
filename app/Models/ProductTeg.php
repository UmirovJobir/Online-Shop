<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTeg extends Model
{
    use HasFactory;

    protected $table = 'product_tegs';
    protected $guarded = false;
}
