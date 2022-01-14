<?php
namespace App\Repositories;

use App\Models\FoodMenu;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\FoodMenuContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class FoodMenuRepository
 *
 * @package \App\Repositories
 */
class FoodMenuRepository extends BaseRepository implements FoodMenuContract
{
    use UploadAble;

    public function __construct(FoodMenu $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFoodMenus(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findFoodMenuById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return FoodMenu|mixed
     */
    public function createFoodMenu(array $params)
    {
        try {
            $collection = collect($params);
            
            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'FoodMenus');
            }

            $merge = $collection->merge(compact('image'));

            $FoodMenu = new FoodMenu($merge->all());

            $FoodMenu->save();

            return $FoodMenu;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }


    /**
     * @param array $params
     * @return mixed
     */
    public function updateFoodMenu(array $params)
    {
        $FoodMenu = $this->findFoodMenuById($params['id']);
        $collection = collect($params)->except('_token');

        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($FoodMenu->image != null) 
                $this->deleteOne($FoodMenu->image);
            

            $image = $this->uploadOne($params['image'], 'FoodMenus');
        }
        $merge = $collection->merge(compact('image'));
        $FoodMenu->update($merge->all());

        return $FoodMenu;
    }


    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFoodMenu($id)
    {
        $FoodMenu = $this->findFoodMenuById($id);

        if ($FoodMenu->image != null)
            $this->deleteOne($FoodMenu->image);
        

        $FoodMenu->delete();

        return $FoodMenu;
    }

}