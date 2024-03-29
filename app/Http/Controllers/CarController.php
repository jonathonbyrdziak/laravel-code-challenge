<?php

namespace App\Http\Controllers;

use App\Car;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CarController extends Controller
{
    protected $showRelationships = ['address', 'owner'];
    
    /**
     * Return a list of all cars.
     *
     * @return array
     */
    public function index(): array
    {
        return Car::all()->toArray();
    }

    /**
     * Return a single car.
     *
     * @param Car $car
     * @return Car
     */
    public function show(Car $car): Car
    {
        foreach ($this->showRelationships as $relationship) {
            $car->$relationship; // pull the relationship
        }
        $car->showRelationships = $this->showRelationships;
        $car->showFillable = $car->getFillable();
        return $car;
    }

    /**
     * Store an car.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $car = Car::create($request->all());

        return response()->json($car, 201);
    }

    /**
     * Update an car.
     *
     * @param Request $request
     * @param Car $car
     * @return JsonResponse
     */
    public function update(Request $request, Car $car): JsonResponse
    {
        $car->update($request->all());

        return response()->json($car, 200);
    }

    /**
     * Delete an car.
     *
     * @param Car $car
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Car $car): JsonResponse
    {
        $car->delete();

        return response()->json(null, 204);
    }
}
