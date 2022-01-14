<?php

namespace Database\Factories;
use App\Models\FoodMenu;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodMenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = FoodMenu::class;

    public function definition()
    {
        return [
            'name'          =>  $this->faker->name,
            'description'   =>  $this->faker->realText(100),
            'parent_id'     =>  1,
        ];
    }
}
