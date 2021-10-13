<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dependent;

class ControllerDependents extends Controller
{
    public function get_dependent(Request $request){

        $id = $request["id"];

        $dados = Dependent::where("user_id",$id)
        ->get();

        return $dados;
    }
}
