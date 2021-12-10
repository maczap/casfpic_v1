<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacaoCadastro extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $nome;

    public function __construct($dados)
    {
        $this->nome = $dados["nome"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@casfpic.org.br','CASFPIC')
        ->subject('Novo Cadastro - '. $this->nome)
        ->view('Emails.NotificacaoCad')

        ->with([
            'nome'   => $this->nome
            
        ]);         
    }
}
