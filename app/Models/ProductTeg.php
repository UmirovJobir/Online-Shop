<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTeg extends Model
{
    use HasFactory;

    protected $table = 'product_teg';
    protected $guarded = false;


    public function teg()
    {
        return $this->belongsTo(Teg::class, 'teg_id', 'id');
    }
}
