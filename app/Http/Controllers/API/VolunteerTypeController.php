<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VolunteerTypeResource;
use App\Models\VolunteerType;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VolunteerTypeController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(int $volunteerTypeId)
    {
        try {
            return new VolunteerTypeResource(VolunteerType::query()->findOrFail($volunteerTypeId)->first());
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Catégorie de bénévole non trouvée',
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showAll()
    {
        try {
            $volunteerTypes = VolunteerType::all();

            return response()->json(VolunteerTypeResource::collection($volunteerTypes), 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Catégories de bénévole non trouvée',
            ], 404);
        }
    }
}
