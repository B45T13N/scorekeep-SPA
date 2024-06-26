<?php

namespace App\Http\Controllers;

use App\Models\LocalTeam;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocalTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Teams', [
            'teams' => LocalTeam::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string  $visitorTeamName
     * @param  int  $gameId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $localTeam = new LocalTeam();
            $localTeam->name = $validatedData['name'];

            $localTeam->save();

            // Réponse de succès
            return response()->json(['message' => 'Equipe locale créée avec succès'], 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Erreur lors de l\'enregistrement de l\'équipe locale'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $visitorTeamId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $localTeamId)
    {
        try {
            $localTeam = LocalTeam::findOrFail($localTeamId);

            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);

            $localTeam->name = $validatedData['name'];

            $localTeam->save();

            // Réponse de succès
            return response()->json(['message' => 'Equipe locale mise à jour avec succès'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Equipe visiteur non trouvée',
                'exception' => $e->getMessage(),
            ], 404);
        }
    }

    /**
     * Update the localteam password in storage.
     */
    public function passwordUpdate(Request $request)
    {
        $localTeam = LocalTeam::findOrFail(auth()->user()->localTeamId);

        $validatedData = $request->validate([
            'password' => 'required|string',
        ]);

        $localTeam->token = $validatedData['password'];

        $localTeam->save();

        return redirect(route('dashboard', absolute: false));
    }
}
