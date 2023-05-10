<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{

    const CATEGORIES = 'categories';
    const COLORS = 'colors';
    const PRICES = 'prices';
    const TEGS = 'tegs';

    public function getCallbacks(): array
    {
        return [
            self::CATEGORIES => [$this, 'categories'],
            self::COLORS => [$this, 'colors'],
            self::PRICES => [$this, 'prices'],
            self::TEGS => [$this, 'tegs'],
        ];
    }


    public function categories(Builder $builder, $value)
    {
        $builder->whereIn('category_id', $value);
    }

    public function colors(Builder $builder, $value)
    {
        $builder->whereHas('colors', function ($b) use ($value){
            $b->whereIn('color_id', $value);
        });
    }

    public function prices(Builder $builder, $value)
    {
        $builder->whereBetween('price', $value);
    }

    public function tegs(Builder $builder, $value)
    {
        $builder->whereHas('tegs', function ($b) use ($value){
            $b->whereIn('teg_id', $value);
        });
    }
}
