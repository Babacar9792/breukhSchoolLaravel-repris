<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnneeScolaireRequest;
use App\Models\AnneeScolaire;
use App\Traits\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class AnneeScolaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Archive;
    public function index()
    {
        //
        // return AnneeScolaire::where(["etat" => 1])->pluck("libelle_annee");
        
        return ["message" => "Liste des années scolaires", "annees"  => $this->lister("annee_scolaires", ["libelle_annee"])];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnneeScolaireRequest $request)
    {
        //
        ["libelle" => $libelle] = $request;
        $long = explode('-', $libelle);
        $difference = $long[1] - $long[0];
        if ($difference != 1) {
            return ["message" => [__("messages.years invalide")]];
        }
        if (AnneeScolaire::where([
            "libelle_annee" => $libelle,
            "etat" => 1
        ])->exists()) {

            return ["message" => [__("messages.Year exist")]];
        }
        $annee = AnneeScolaire::where([
            "libelle_annee" => $libelle,
            "etat" => 0
        ])->first();
        if ($annee) {
            $this->archiver("annee_scolaires", $annee->id, 1);
        } else {

            AnneeScolaire::whereIn()->insert(["libelle_annee" => $libelle]);
        }
        return ["message" => [__('messages.insert successfully')]];
    }




    /**
     * Display the specified resource.
     */
    public function show(AnneeScolaire $anneeScolaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnneeScolaireRequest $request)
    {
        ["libelle" => $libelle] = $request;
        ["anneescolaire" => $anneeScolaire] = $request;
        $long = explode("-", $libelle);
        if ($long[1] - $long[0] != 1) {
            return ["message" => [__("messages.years invalide")]];
        }
        try {
            AnneeScolaire::whereIn("id", [$anneeScolaire])->update([
                "libelle_annee" => $libelle
            ]);
            return ["message" => [__("messages.data updated successfully")]];
        } catch (\Throwable $th) {
            return ["message" => $th->getMessage()];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnneeScolaire $anneeScolaire)
    {
        //
    }

    public function archive(HttpFoundationRequest $request)
    {
        ["id" => $id] = $request;
        try {
            $this->archiver("annee_scolaires", $id, 0);
            return ["message" => [__("messages.Deleted")]];
        } catch (\Throwable $th) {
            return ["message" => [__("messages.Error")]];
            //throw $th;
        }
    }
}
