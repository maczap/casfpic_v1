<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Services\PagarmeRequestService;

class ControllerDash extends Controller
{

    public function __construct(PagarmeRequestService $pagarme){
        $this->pagarme = $pagarme;
    }
    public function getBalance(){
        $dados =  $this->pagarme->getBalance();

        $available = $dados["available"]["amount"];
        $available = $available/100;
        $available = number_format($available, 2);

        $waiting_funds = $dados["waiting_funds"]["amount"];
        $waiting_funds = $waiting_funds/100;
        $waiting_funds = number_format($waiting_funds, 2);       
        
        $transferred = $dados["transferred"]["amount"];
        $transferred = $transferred/100;
        $transferred = number_format($transferred, 2);  

        $dados["available"]["amount"] = $available;
        $dados["waiting_funds"]["amount"] = $waiting_funds;
        $dados["transferred"]["amount"] = $transferred;
        return $dados;
    }
    public function dash_cadastros(){

        $dados =  User::join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
        ->select('users.*', 'subscriptions.plano', 'users.vinculo as pmt','subscriptions.status', 'subscriptions.status_detail', 'subscriptions.created_at', DB::raw("DATE_FORMAT(users.created_at, '%d/%m/%Y') as data"))
        ->addSelect(['promotor' => User::select('name')
        ->whereColumn('promotor_code', 'pmt')
        ->limit(1)  
        ])           
        ->where("cpf","<>", "26460284822")
        ->Where("promotor",0)
        ->orderBy('updated_at', 'desc')
        ->get();
        return $dados;     
    }

    public function get_cadastros(Request $request){
        $id = $request["id"];

        $dados =  User::join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
        ->select('users.*', 'users.vinculo as pmt','subscriptions.plano', 'subscriptions.status', 'subscriptions.status_detail', 'subscriptions.created_at')
        ->where("users.id",$id)
        ->addSelect(['promotor' => User::select('name')
        ->whereColumn('promotor_code', 'pmt')
        ->limit(1)  
        ])   
     
        ->get();
        if(!empty($dados)){
            return $dados[0]; 
        }
        return [];     
    }    


    public function dash_cadastros2(){

        $dados =  User::join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
        ->select('users.*', 'subscriptions.plano')
        ->where('subscriptions.status','paid')
        ->orderBy('subscriptions.id', 'desc')
        ->limit(10)
        ->get();   
        
        foreach($dados as $item){
            $nome = $item->name;
            $plano = $item->plano;
            $status = $item->status;
            $email = $item->email;
            $endereco = $item->endereco;
            $numero = $item->numero;
            $complemento = $item->complemento;
            $bairro = $item->bairro;
            $cep = $item->cep;
            $cidade = $item->cidade;
            $uf = $item->uf;
            $cpf = $item->cpf;
            $rg = $item->rg;
            $sexo = $item->sexo;

            if($sexo == 1){
                $sexo = "Feminino";
            } else{
                $sexo = "Masculino";
            }
            $nascimento = $item->nascimento;
            $n = explode("-", $nascimento);
            $nascimento = $n[2];
            $nascimento .= "/";
            $nascimento .= $n[1];
            $nascimento .= "/";
            $nascimento .= $n[0];

            $ecivil = $item->ecivil;

           
            
            if($ecivil == 0) { $ecivil = "Solteiro";}
            if($ecivil == 1) { $ecivil = "Casado";}
            if($ecivil == 2) { $ecivil = "Solteiro";}
            if($ecivil == 3) { $ecivil = "Divorciado";}
            if($ecivil == 4) { $ecivil = "Viúvo";}
            if($ecivil == 5) { $ecivil = "Amasiado";}

            $area_atuacao = $item->area_atuacao;


            if($area_atuacao == 1) { $area_atuacao = "Comercio";}
            if($area_atuacao == 2) { $area_atuacao = "Indústria";}
            if($area_atuacao == 3) { $area_atuacao = "Funcionalismo Público Municipal";}
            if($area_atuacao == 4) { $area_atuacao = "Funcionalismo Público Estadual";}
            if($area_atuacao == 5) { $area_atuacao = "Funcionalismo Público Federal";}


            $profissao = $item->profissao;

            $celular = $item->celular;

            echo "NOME: ".$nome ."<br>";
            echo "CPF: ".$cpf ."<br>";
            echo "RG: ".$rg ."<br>";
            echo "NASCIMENTO: ".$nascimento."<br>";
            echo "SEXO: ".$sexo ."<br>";
            echo "E-CIVIL: ".$ecivil ."<br>";
            echo "ÁREA ATUAÇÃO: ".$area_atuacao ."<br>";
            echo "E-MAIL: ".$email ."<br>";
            echo "PLANO: ".$plano ."<br>";
            echo "ENDERECO: ".$endereco ."<br>";
            echo "NUMERO: ".$numero ."<br>";
            echo "COMPLEMENTO: ".$complemento ."<br>";
            echo "BAIRRO: ".$bairro ."<br>";
            echo "CEP: ".$cep ."<br>";
            echo "CIDADE: ".$cidade ."<br>";
            echo "UF: ".$uf ."<br>";
            echo "<br>";
            echo "<br>";
        }
    }    
}
