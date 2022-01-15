<?php

namespace App\Http\Controllers\Admin;

use App\Traits\UploadAble;
use App\Models\FoodImage;
use Illuminate\Http\Request;
use App\Contracts\FoodContract;
use App\Http\Controllers\Controller;

class FoodImageController extends Controller
{
    //

    use UploadAble;

    protected $foodRepository;

    public function __construct(FoodContract $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }
    
    public function upload(Request $request)
    {
        $food = $this->foodRepository->findFoodById($request->food_id);

        if ($request->has('image')) {

            $image = $this->uploadOne($request->image, 'foods');

            $foodImage = new FoodImage([
                'full'      =>  $image,
            ]);

            $food->images()->save($foodImage);
        }

        return response()->json(['status' => 'Success']);
    }

    public function delete($id)
    {
        $image = FoodImage::findOrFail($id);

        if ($image->full != '') {
            $this->deleteOne($image->full);
        }
        $image->delete();

        return redirect()->back();
    }


}
