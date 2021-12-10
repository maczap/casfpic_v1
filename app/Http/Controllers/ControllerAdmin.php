<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class ControllerAdmin extends Controller
{
    public function __construct(Admin $admin){

        $this->_admin = $admin;

    }


    public function baixa(Request $request){

        $id = $request["id"];
        $payment = $request["payment"];

        $this->_admin->baixa($id, $payment);

    }
}
