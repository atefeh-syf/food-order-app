<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodMenu extends Model
{
    use HasFactory;

    protected $table = 'food_menus';

    protected $fillable = [
        'name', 'description', 'parent_id',  'image'
    ];

    protected $casts = [
        'parent_id' =>  'integer'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    public function parent()
    {
        return $this->belongsTo(FoodMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(FoodMenu::class, 'parent_id');
    }
}
