<?php
namespace App\Contracts;

/**
 * Interface FoodMenuContract
 * @package App\Contracts
 */
interface FoodMenuContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listFoodMenus(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findFoodMenuById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createFoodMenu(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateFoodMenu(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteFoodMenu($id);
}