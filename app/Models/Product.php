<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Filterable;

    const TRUE = 1;
    const FALSE = 0;

    static function getStatus(){
        return [
            self::TRUE => 'Faol',
            self::FALSE => 'Faol emas',
        ];
    }
    public function getStatusTitleAttribute(){
        return self::getStatus()[$this->status];
    }

    protected $table = 'products';
    protected $guarded = false;


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class,'color_products','product_id','color_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

}
