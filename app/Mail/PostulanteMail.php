<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostulanteMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Nuevo Postulante";
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
        return $this->view('mails.postulante')-> with([
            "nombre" => $this -> data -> nombre,
            "correo" => $this -> data -> correo,
            "estado" => $this -> data -> estado,
            "municipio" => $this -> data -> municipio,
            "telefono" => $this -> data -> telefono,
            "organizacion" => $this -> data -> organizacion,
            "talleres" => isset($this -> data -> talleres) ? 1 : 0,
            "documentales" => isset($this -> data -> documentales) ? 1 : 0,
            "conversatorios" => isset($this -> data -> conversatorios) ? 1 : 0,
            "obras" => isset($this -> data -> obras) ? 1 : 0,
        ]);
    }
}
