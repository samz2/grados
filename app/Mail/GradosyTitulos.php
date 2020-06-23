<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GradosyTitulos extends Mailable
{
    use Queueable, SerializesModels;

    public $adjunto;
    public $subject;
    public $body;

    public function __construct($subject,$attach,$mensaje)
    {
      $this->adjunto    = $attach;
      $this->subject    = $subject;
      $this->body       = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('mails.template');
        $email = $this->view('mails.template');

        // $archivosadjuntos es una matriz con rutas de archivos de archivos adjuntos
        foreach($this->adjunto as $archivo){
        
            $email->attach($archivo);
        }
        return $email;
    }
}
