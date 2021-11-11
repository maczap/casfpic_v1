<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Split;

class ControllerSplit extends Controller
{
    public function __construct(Split $split){

        $this->split = $split;

    }

    public function get_pagamentos(){

        $dados = $this->split->pagamentos();

        return $dados;

    }
}
