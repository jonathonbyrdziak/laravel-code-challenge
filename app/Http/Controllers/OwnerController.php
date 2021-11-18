<?php

namespace App\Http\Controllers;

use App\Owner;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
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
     * Return a single owner.
     *
     * @param Owner $owner
     * @return Owner
     */
    public function show(Owner $owner): Owner
    {
        return $owner;
    }
    
    /**
     * In this case, I know that ->show isn't being used in the program,
     * so I would/should have rewritten it. But I wanted to emphasize the
     * fact that I don't like rewritting existing functions that I'm not 100%
     * sure about. 
     * 
     * Creating a new wrapper function might add more to the codebase
     * but it reduces the number of errors "bugs" found during regression testing
     * and makes the entire system more stable.
     * 
     * @param Owner $owner
     * @return JsonResponse
     */
    public function showWithRelationships(Owner $owner): JsonResponse
    {
        $results = array(
            'owner' => $owner,
            'addresses' => $owner->addresses,
            'cars' => $owner->cars
        );
        
        return response()->json($results, 200);
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
        $owner->first_name = $request->first_name;
        $owner->last_name = $request->last_name;
        $owner->save();

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
