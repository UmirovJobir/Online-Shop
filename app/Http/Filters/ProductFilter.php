<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
    public const USER_ID = 'user_id';
    public const TITLE = 'title';
    public const PRICE = 'price';
    public const STATUS = 'status';
    public const CATEGORY_ID = 'category_id';
    public const COLORS = 'colors';
    public const TAGS = 'tags';

    public function getCallbacks(): array
    {
        return [
//            self::TITLE => [$this, 'title'],
//            self::PRICE => [$this, 'price'],
//            self::CATEGORY_ID => [$this, 'categoryId'],
            self::CATEGORY_ID => [$this, 'categories'],
            self::COLORS => [$this, 'colors'],
            self::TAGS => [$this, 'tags'],
        ];
    }

//    public function title(Builder $builder, $value)
//    {
//        $builder->where('title', 'like', "%{$value}%");
//
//    }
//
//    public function categoryId(Builder $builder, $value)
//    {
//        $builder->where('category_id', $value);
//    }
//
//    public function price(Builder $builder, $value)
//    {
//        $builder->where('price', $value);
//    }

    protected function categories(Builder $builder, $value)
    {
        $builder->whereIn('category_id', $value);
    }


    public function colors(Builder $builder, $value)
    {
        $builder->whereHas('colors', function ($b) use ($value){
            $b->whereIn('color_id', $value);
        });
    }

    public function tags(Builder $builder, $value)
    {
        $builder->whereHas('tags', function ($b) use ($value){
            $b->whereIn('tag_id', $value);
        });
    }
}
