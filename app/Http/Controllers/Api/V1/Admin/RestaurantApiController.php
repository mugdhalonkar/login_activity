<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Restaurant;

class RestaurantsApiController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();

        return $restaurants;
    }

    public function store(StoreRestaurantRequest $request)
    {
        return Restaurant::create($request->all());
    }

    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        return $restaurant->update($request->all());
    }

    public function show(Restaurant $restaurant)
    {
        return $restaurant;
    }

    public function destroy(Restaurant $restaurant)
    {
        return $restaurant->delete();
    }
}
