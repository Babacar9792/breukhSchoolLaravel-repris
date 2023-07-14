<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Traits\Archive;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use Archive;
    public function index()
    {
        return ["message" => "Liste des classes","Classes"  =>$this->lister("classes", ["libelle_classe"])];
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClasseRequest $request)
    {
        //
        ["libelle" => $libelle] = $request;
        ["niveau" => $niveau] = $request;
        try {
            Classe::insert([
                "libelle_classe" => $libelle,
                "niveau_id" => $niveau

            ]);
            return ["message" => [__("messages.insert successfully")]];
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ClasseRequest $request)
    {
        ["classe" => $classe] = $request;
        ["libelle" => $libelle] = $request;
        Classe::whereIn("id", [$classe])->update([
            "libelle_classe" => $libelle
        ]);
        return ["message" => [__("messages.data updated successfully")]];
        //
    }

    public function archive(HttpFoundationRequest $request)
    {
        ["id" => $id] = $request;
        try {
            $this->archiver("classes", $id, 0);
            return ["message"=>[__("messages.Deleted")]];
        } catch (\Throwable $th) {
            return ["message" => [__("messages.Error")]];
            //throw $th;
        }
    }

   
}
