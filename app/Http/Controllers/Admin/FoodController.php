<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Contracts\BaseContract;
use App\Contracts\FoodMenuContract;
use App\Contracts\FoodContract;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFoodFormRequest;  

class FoodController extends BaseController
{
    //

    protected $menuRepository;

    protected $foodRepository;

    public function __construct( FoodMenuContract $menuRepository, FoodContract $foodRepository )
    {
        $this->menuRepository = $menuRepository;
        $this->foodRepository = $foodRepository;
    }

    public function index()
    {
        $foods = $this->foodRepository->listFoods();

        $this->setPageTitle('Foods', 'Foods List');
        return view('admin.foods.index', compact('foods'));
    }


    public function create()
    {

        $menus = $this->menuRepository->listFoodMenus('name', 'asc');

        $this->setPageTitle('Foods', 'Create Food');
        return view('admin.foods.create', compact('menus'));
    }

    public function store(StoreFoodFormRequest $request)
    {
        $params = $request->except('_token');

        $food = $this->foodRepository->createFood($params);

        if (!$food) {
            return $this->responseRedirectBack('Error occurred while creating food.', 'error', true, true);
        }
        return $this->responseRedirect('admin.foods.index', 'Food added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $food = $this->foodRepository->findFoodById($id);
        $menus = $this->menuRepository->listFoodMenus('name', 'asc');

        $this->setPageTitle('Foods', 'Edit Food');
        return view('admin.foods.edit', compact('menus','food'));
    }

    public function update(StoreFoodFormRequest $request)
    {
        $params = $request->except('_token');

        $food = $this->foodRepository->updateFood($params);

        if (!$food) {
            return $this->responseRedirectBack('Error occurred while updating food.', 'error', true, true);
        }
        return $this->responseRedirect('admin.foods.index', 'Food updated successfully' ,'success',false, false);
    }


}
