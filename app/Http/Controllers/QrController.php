<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use Illuminate\Support\Facades\Storage;

class QrController extends Controller
{
    public function index(Request $request){
        $code = $request["code"];
        \QrCode::size(500)
        
        ->generate('http://casfpic.org.br/p/'.$code, public_path('images/qrcode/'.$code.'.png'));        
        // return view('qrCode');
        $img =  base64_encode(QrCode::format('png')->size(350)->generate('http://casfpic.org.br/p/'.$code));
        return '<img src="data:image/png;base64,'. $img .'">';
    }    
}
