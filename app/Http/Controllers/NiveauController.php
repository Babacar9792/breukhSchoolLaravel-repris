<?php

namespace App\Http\Controllers;

use App\Http\Requests\NiveauRequest;
use App\Http\Resources\NiveauResource;
use App\Models\AnneeScolaire;
use App\Models\Niveau;
use App\Traits\Archive;
use App\Traits\JoinQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Archive;
    use JoinQuery;

    public function index(Request $request)
    {
        return NiveauResource::collection(Niveau::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NiveauRequest $request)
    {
        //
        ["libelle" => $libelle] = $request;
        try {
            Niveau::insert([
                "libelle_niveau" => $libelle,
                "annee_scolaire_id" => 1

            ]);
            return ["message" => [__("messages.insert successfully")]];
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NiveauRequest $request)
    {
        // Niveau $niveau
        ["niveau" => $niveau] = $request;
        ["libelle" => $libelle] = $request;
        Niveau::whereIn("id", [$niveau])->update([
            "libelle_niveau" => $libelle
        ]);
        return ["message" => [__("messages.data updated successfully")]];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveau $niveau)
    {
        //
    }

    public function archive(HttpFoundationRequest $request)
    {
        ["id" => $id] = $request;
        try {
            $this->archiver("niveaux", $id, 0);
            return ["message" => [__("messages.Deleted")]];
        } catch (\Throwable $th) {
            return ["message" => [__("messages.Error")]];
            //throw $th;
        }
    }
}
