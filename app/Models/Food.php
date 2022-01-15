<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'foods';

     /**
     * @var array
     */
    protected $fillable = ['name','description', 'quantity' , 'price'];

    /**
     * @var array
     */
    protected $casts = [
        'quantity'  =>  'integer',
    ];


    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(FoodImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(FoodMenu::class, 'food_food_menus', 'food_id', 'food_menu_id');
    }

}
