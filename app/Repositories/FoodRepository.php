<?php
namespace App\Repositories;

use App\Models\Food;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\FoodContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class FoodRepository
 *
 * @package \App\Repositories
 */
class FoodRepository extends BaseRepository implements FoodContract
{
    use UploadAble;

    /**
     * FoodRepository constructor.
     * @param Food $model
     */
    public function __construct(Food $model)
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
    public function listFoods(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findFoodById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Food|mixed
     */
    public function createFood(array $params)
    {
        try {
            $collection = collect($params);
            $status = $collection->has('status') ? 1 : 0;

            $merge = $collection->merge(compact('status'));
            
            $food = new Food($merge->all());

            $food->save();

            if ($collection->has('menus')) {
                $food->menus()->sync($params['menus']);
            }
            return $food;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFood(array $params)
    {
        $food = $this->findFoodById($params['food_id']);

        $collection = collect($params)->except('_token');

        $status = $collection->has('status') ? 1 : 0;
        $merge = $collection->merge(compact('status', 'featured'));
        $food->update($merge->all());

        if ($collection->has('menus')) {
            $food->menus()->sync($params['menus']);
        }

        return $food;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteFood($id)
    {
        $food = $this->findFoodById($id);

        $food->delete();

        return $food;
    }
}