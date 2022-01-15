<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\FoodMenuContract;

class FoodMenuController extends Controller
{
    //

    protected $foodMenuRepository;

    public function __construct(FoodMenuContract $foodMenuRepository)
    {
        $this->foodMenuRepository = $foodMenuRepository;
    }

    public function show($id)
    {
        $foodMenu = $this->foodMenuRepository->findFoodFoodsMenuById($id);
        return view('general.pages.foodMenu', compact('foodMenu'));
    }
}
