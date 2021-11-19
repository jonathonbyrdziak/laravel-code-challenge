<?php

namespace App\Http\Controllers;

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
