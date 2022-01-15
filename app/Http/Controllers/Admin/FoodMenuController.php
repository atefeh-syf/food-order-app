<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Contracts\FoodMenuContract;
use App\Contracts\BaseContract;
use App\Http\Controllers\BaseController;

class FoodMenuController extends BaseController
{
    //

    /**
     * @var FoodMenuContract
     */
    protected $FoodMenuRepository;

    /**
     * FoodMenuController constructor.
     * @param FoodMenuContract $FoodMenuRepository
     */
    public function __construct(FoodMenuContract $FoodMenuRepository)
    {
        $this->FoodMenuRepository = $FoodMenuRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $FoodMenus = $this->FoodMenuRepository->listFoodMenus();

        $this->setPageTitle('FoodMenus', 'List of all FoodMenus');
        return view('admin.FoodMenus.index', compact('FoodMenus'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $FoodMenus = $this->FoodMenuRepository->listFoodMenus('id', 'asc');

        $this->setPageTitle('FoodMenus', 'Create FoodMenu');
        return view('admin.FoodMenus.create', compact('FoodMenus'));
    }


     /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $FoodMenu = $this->FoodMenuRepository->createFoodMenu($params);

        if (!$FoodMenu) {
            return $this->responseRedirectBack('Error occurred while creating FoodMenu.', 'error', true, true);
        }
        return $this->responseRedirect('admin.foodmenus.index', 'FoodMenu added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetFoodMenu = $this->FoodMenuRepository->findFoodMenuById($id);
        $FoodMenus = $this->FoodMenuRepository->listFoodMenus();

        $this->setPageTitle('FoodMenus', 'Edit FoodMenu : '.$targetFoodMenu->name);
        return view('admin.FoodMenus.edit', compact('FoodMenus', 'targetFoodMenu'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $FoodMenu = $this->FoodMenuRepository->updateFoodMenu($params);

        if (!$FoodMenu) {
            return $this->responseRedirectBack('Error occurred while updating FoodMenu.', 'error', true, true);
        }
        return $this->responseRedirectBack('FoodMenu updated successfully' ,'success',false, false);
    }
    
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $FoodMenu = $this->FoodMenuRepository->deleteFoodMenu($id);

        if (!$FoodMenu) {
            return $this->responseRedirectBack('Error occurred while deleting FoodMenu.', 'error', true, true);
        }
        return $this->responseRedirect('admin.foodmenus.index', 'FoodMenu deleted successfully' ,'success',false, false);
    }

}
