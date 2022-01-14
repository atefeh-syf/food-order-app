<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodMenu;

class FoodMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        FoodMenu::create([
            'name'          =>  'root FoodMenu',
            'description'   =>  'This is the root FoodMenu, undeletable!',
            'parent_id'     =>  null,
        ]);

        //factory('App\Models\FoodMenu', 10)->create();
    }
}
