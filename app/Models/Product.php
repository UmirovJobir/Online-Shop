<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Filterable;

    protected $table = 'products';
    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        if ($this->preview_image == null) {
            return null;
        }else{
            return url('storage/' . $this->preview_image);
        }
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class,'color_products','product_id','color_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function tegs()
    {
        return $this->belongsToMany(Teg::class, 'product_tegs', 'product_id', 'teg_id');
    }

}
