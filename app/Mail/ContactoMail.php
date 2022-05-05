<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Contacto";
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this -> data = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.contacto')-> with([
            "nombre" => $this -> data -> nombre,
            "apellidos" => $this -> data -> apellidos,
            "correo" => $this -> data -> correo,
            "telefono" => $this -> data -> telefono,
            "mensaje" => $this -> data-> mensaje,
            "whatsapp" => isset($this -> data-> whatsapp) ? 'SI' : 'NO',
        ]);
    }
}
