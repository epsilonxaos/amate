<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AliadoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Nuevo Aliado";
    protected $data;

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
        return $this->view('mails.aliado')-> with([
            "nombre" => $this -> data -> nombre,
            "apellidos" => $this -> data -> apellidos,
            "correo" => $this -> data -> correo,
            "telefono" => $this -> data -> telefono,
            "mensaje" => $this -> data-> mensaje,
        ]);
    }
}
