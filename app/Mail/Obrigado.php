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

    public function __construct($dados)
    {
        $this->nome    = ucfirst($dados["nome"]);
        $this->method  = $dados["method"];
        $this->url     = $dados["url"];
     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@servclube.com.br','CASFPIC')
        ->subject('Seja muito bem-vindo(a) MARCOS!        ')
        ->view('Emails.obrigado')
        ->with([
            'nome'   => $this->nome,          
            'method' => $this->method,
            'url'    => $this->url
        ]);          
    }
}
