<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Inmueblesx;

class NotificacionRegistro extends Mailable
{
    use Queueable, SerializesModels;
    public $inmueble;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $inmueble)
    {
        $this->inmueble=$inmueble;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notificacion de registro del inmueble '.$this->inmueble->alias)->view('correos.inmueble_registrado');
    }
}
