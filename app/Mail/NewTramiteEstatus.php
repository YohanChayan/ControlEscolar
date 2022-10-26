<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTramiteEstatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tramite)
    {
        $this->tr_id = $tramite->id;
        $this->tr_nombre_tramite = $tramite->tramite->nombre_tramite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.newEstatus')->subject("Control Escolar")
        ->with('tr_id', $this->tr_id)
        ->with('tr_nombre_tramite', $this->tr_nombre_tramite)
        ;
    }
}
