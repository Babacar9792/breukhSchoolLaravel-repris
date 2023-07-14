<?php



namespace App\Traits;


trait JoinQuery
{



    function joinTable($model, $joinRelation)
    {
        $table = explode(",", $joinRelation);
        foreach ($table as  $value) {
            # code...
            if (method_exists($model, $value)) {
    
                echo $model::with($value)->get();
            }
            echo $model::all();
            
        }
    }
}
