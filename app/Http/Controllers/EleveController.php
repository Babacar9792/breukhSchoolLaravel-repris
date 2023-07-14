<?php

namespace App\Http\Controllers;

use App\Http\Requests\EleveRequest;
use App\Models\Eleve;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ELeveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EleveRequest $request)
    {
        //
        ["prenom" => $prenom] = $request;
        ["nom" => $nom] = $request;
        ["sexe" => $sexe] = $request;
        ["date_naissance" => $date_naissance] = $request;
        ["lieu_naissance" => $lieu_naissance] = $request;
        ["profil" => $profil] = $request;
        ["classe" => $classe] = $request;

        try {
            DB::beginTransaction();
            $eleve = new Eleve();
        // $eleve = Eleve::insert([
            $eleve->prenom = $prenom;
            $eleve->nom = $nom;
            $eleve->sexe = $sexe;
            $eleve->profil = $profil;
            $eleve->date_naissance = $date_naissance;
            $eleve->lieu_naissance = $lieu_naissance;
            $eleve->lieu_naissance = $lieu_naissance;
            $eleve->save();

        // ]);

        Inscription::insert([
            "eleve_id" => $eleve->id,
            "classe_id" => $classe,
            "annee_scolaire_id" => 1,
            "date_inscription" => now() 
        ]);

       DB::commit();
        return $eleve;
        } catch (\Throwable $th) {
            DB::rollBack();
            // return ["message" => [__("messages.Error")]];
            return $th->getMessage();
        }
        

        /* 
       
        
        $eleve = new Eleve();
            $eleve->prenom = $request->prenom;
            $eleve->nom = $request->nom;
            $eleve->date_naissance = $request->date_naissance;
            $eleve->lieu_naissance = $request->lieu_naissance;
            $eleve->profil = $request->profil;
            $eleve->sexe = $request->sexe;
        
        
        */



    }

    /**
     * Display the specified resource.
     */
 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eleve $eleve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
  
}
