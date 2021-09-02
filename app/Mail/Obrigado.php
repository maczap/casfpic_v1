<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Obrigado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nome;
    public $method;
    public $url;
    public $email;
    public $plano;
    public $boleto_url;
    public $boleto_barcode;
    public $periodo;
    public $status;
    

    public function __construct($dados)
    {
        $this->nome         = ucfirst($dados["nome"]);
        $n = \explode(" ", $this->nome);
        $this->nome = $n[0];
        $this->method       = $dados["payment_method"];
        $this->email        = $dados["email"];
        $this->boleto_url   = $dados["boleto_url"];
        $this->boleto_barcode = $dados["boleto_barcode"];
        $this->status       = $dados["status"];
        $this->plano        = $dados["plano"];
        $this->periodo      = $dados["periodo"];
     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@servclube.com.br','CASFPIC')
        ->subject("Seja muito bem-vindo(a) $this->nome!")
        ->view('Emails.obrigado')
        ->with([
            'nome'           => $this->nome,          
            'method'         => $this->method,
            'periodo'        => $this->periodo,
            'boleto_url'     => $this->boleto_url,
            'boleto_barcode' => $this->boleto_barcode
        ]);          
    }
}
