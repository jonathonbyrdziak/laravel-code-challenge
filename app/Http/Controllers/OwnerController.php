<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Owner;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    protected $showRelationships = ['cars', 'addresses'];
    
    /**
     * Return a list of all owners.
     *
     * @return array
     */
    public function index(): array
    {
        return Owner::all()->toArray();
    }
    
    /**
     * Returns the average number of cars and addresses for the owners
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function averagesWidget()
    {
        // check to see if the tables are up to date
        $emptyCount = DB::table('owners')->selectRaw('count(*)')
            ->whereNull('total_addresses')
            ->orWhereNull('total_cars')
            ->first()->count;
        
        if ($emptyCount) {
            DB::statement('UPDATE owners set total_addresses = (SELECT count(*) FROM addresses WHERE owners.id = addresses.owner_id)');
            DB::statement('UPDATE owners set total_cars = (SELECT count(*) FROM cars WHERE owners.id = cars.owner_id)');
        }
        
        $ttlOwners = DB::table('owners')->selectRaw('count(*)')->first()->count;
        $ttlAddresses = DB::table('addresses')->selectRaw('count(*)')->first()->count;
        $ttlCars = DB::table('cars')->selectRaw('count(*)')->first()->count;
        
        $avgAddresses = round($ttlAddresses/$ttlOwners,0);
        $avgCars = round($ttlCars/$ttlOwners,0);
        
        $response = array();
        $response['owners'] = $ttlOwners;
        $response['avgaddresses'] = $avgAddresses;
        $response['ttladdresses'] = $ttlAddresses;
        $response['avgcars'] = $avgCars;
        $response['ttlcars'] = $ttlCars;
        
        return response()->json($response, 200);
    }

    /**
     * Return a single owner.
     *
     * @param Owner $owner
     * @return Owner
     */
    public function show(Owner $owner): Owner
    {
        foreach ($this->showRelationships as $relationship) {
            $owner->$relationship; // pull the relationship
        }
        $owner->showRelationships = $this->showRelationships;
        $owner->showFillable = $owner->getFillable();
        return $owner;
    }

    /**
     * Store an owner.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $owner = Owner::create($request->all());

        return response()->json($owner, 201);
    }

    /**
     * Update an owner.
     *
     * @param Request $request
     * @param Owner $owner
     * @return JsonResponse
     */
    public function update(Request $request, Owner $owner): JsonResponse
    {
        $owner->update($request->all());

        return response()->json($owner, 200);
    }

    /**
     * Delete an owner.
     *
     * @param Owner $owner
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(Owner $owner): JsonResponse
    {
        $owner->delete();

        return response()->json(null, 204);
    }
}
