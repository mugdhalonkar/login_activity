<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRestaurantRequest;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Restaurant;
use App\RestaurantImage;
use File;

class RestaurantsController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('restaurant_access'), 403);

        $restaurants =Restaurant::leftjoin('restaurant_images', 'restaurants.id', '=', 'restaurant_images.restaurant_id')->where('restaurants.deleted_at','=',null)->get(['restaurants.*', 'restaurant_images.file_name']);

        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('restaurant_create'), 403);

        return view('admin.restaurants.create');
    }

    public function store(StoreRestaurantRequest $request)
    {
        abort_unless(\Gate::allows('restaurant_create'), 403);

        $restaurant = Restaurant::create($request->all());
        $restaurant_id = $restaurant->id;
        $input = $request->all();
        $imageObj = $input['file_name'];
        $fileName = $imageObj->getClientOriginalName();
        if(!empty($restaurant_id)){
          $restaurant_image = RestaurantImage::create(['file_name' => $fileName,'restaurant_id' => $restaurant_id]);
      }
      $restaurant_image_id = $restaurant_image->id;
      if(!empty($restaurant_image_id)){
          $path = public_path() . '/storage/restaurant_images/'.$restaurant_id;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $uploadResponse = $imageObj->move($path, $fileName);
       }

        return redirect()->route('admin.restaurants.index');
    }

    public function edit(Restaurant $restaurant)
    {
        abort_unless(\Gate::allows('restaurant_edit'), 403);

        $restaurant_images = RestaurantImage::where('restaurant_id','=',$restaurant->id)->first();

        return view('admin.restaurants.edit', compact('restaurant','restaurant_images'));
    }

    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        abort_unless(\Gate::allows('restaurant_edit'), 403);
        $restaurant->update($request->all());
        $restaurant_id = $restaurant->id;

        $input = $request->all();
        if(isset($input['file_name']) && !empty($input['file_name'])){
        $imageObj = $input['file_name'];
        $fileName = $imageObj->getClientOriginalName();
        if(!empty($restaurant_id)){
          $restaurant_image = RestaurantImage::where('restaurant_id','=',$restaurant_id)->update(['file_name' => $fileName]);
      }
      $restaurant_image_id = $restaurant_image;
      if(!empty($restaurant_image_id)){
          $path = public_path() . '/storage/restaurant_images/'.$restaurant_id;
                if (!file_exists($path)) {
                    File::makeDirectory($path, $mode = 0777, true, true);
                    }
                    $uploadResponse = $imageObj->move($path, $fileName);
       }
   }


        return redirect()->route('admin.restaurants.index');
    }

    public function show(Restaurant $restaurant)
    {
        abort_unless(\Gate::allows('restaurant_show'), 403);

        return view('admin.restaurants.show', compact('restaurant'));
    }

    public function destroy(Restaurant $restaurant)
    {
        abort_unless(\Gate::allows('restaurant_delete'), 403);

        $restaurant_id = $restaurant->id;
        $restaurant_images = RestaurantImage::where('restaurant_id','=',$restaurant->id)->first();
        $file_name = $restaurant_images->file_name;

        $restaurant_image = RestaurantImage::where('restaurant_id','=',$restaurant_id)->delete();
        $restaurant->delete();
        $filePath = public_path() . '/storage/restaurant_images/'.$restaurant_id.'/'. $file_name;

        if(File::exists($filePath)) {
                    File::delete($filePath);
                }

        return back();
    }

    public function massDestroy(MassDestroyRestaurantRequest $request)
    {
        Restaurant::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
