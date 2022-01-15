<?php

namespace App\Http\Controllers\general;
use Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\FoodContract;

class FoodController extends Controller
{
    //
    protected $foodRepository;

    public function __construct(FoodContract $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    public function show($id)
    {
        $food = $this->foodRepository->findFoodById($id);
        return view('general.pages.food', compact('food'));
    }

    public function addToCart(Request $request)
    {
        $food = $this->foodRepository->findFoodById($request->input('foodId'));
        $options = $request->except('_token', 'foodId', 'price', 'qty');

        Cart::add(uniqid(), $food->name, $request->input('price'), $request->input('qty'), $options);
        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
}
