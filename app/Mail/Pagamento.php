<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Pagamento extends Mailable
{
    use Queueable;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $nome;

    public function __construct($dados)
    {
        $this->nome    = ucfirst($dados["nome"]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@casfpic.org.br','CASFPIC')
        ->subject('Confirmação de pagamento')
        ->view('Emails.pagamento')
        ->withSwiftMessage(function($message) {
            $headers = $message->getHeaders();
            $headers->addTextHeader("X-Mailgun-Variables", '{"type": "group-invitation"}');
            $headers->addTextHeader("X-Mailgun-Tag", "group-invitation");
        })
        ->with([
            'nome'   => $this->nome
        ]);           
    }
}
