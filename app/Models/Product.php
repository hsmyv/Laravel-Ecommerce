<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function scopeMightAlsoLike($query)
    {
        return $query->inRandomOrder()->take(4);
    }


    // protected static function boot()
    // {
    //     parent::boot();
    //     static::addGlobalScope('product', function (Builder $builder) {
    //         $builder->where('status', '=', 'new');
    //     });
    // }
}
