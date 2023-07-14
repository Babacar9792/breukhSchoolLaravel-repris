<?php



Namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Archive
{
    /* 
    * La fonction archiver permet de changer l'etat d'un enregistrement dans une table. Elle prend en parametre le nom de la table, 
    l'id de l'enregistrement et la valeur que doit prendre l'etat. 
    */
    public function archiver($table, $idValue, $valueEtat)
    {
        DB::table($table)->whereIn("id", [$idValue])->update([
            "etat" => $valueEtat
        ]);
    }

    /* 
    * Cette fonction permet de lister les enregistrement d'une table dont l'etat est égal à 1. Elle prend en parametre le nom de la table 
    ainsi qu'un tableau qui contient les colonnes que l'on voudrait afficher.
     */

    public function lister($table, Array $dateForShow)
    {
        return DB::table($table)->where("etat" ,1)->get($dateForShow);
    }

    
}