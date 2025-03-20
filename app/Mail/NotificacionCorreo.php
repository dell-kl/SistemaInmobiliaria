<?php

namespace App\Mail;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionCorreo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $token;
    public $tipo;
    public $usuario;
    public $propiedadNombre;
    public $address;

    public $fecha;
    public $nota;
    public $comentario;
    public function __construct(
        $token,
        $tipo = "reseteo",
        $usuario = "",
        $propiedadNombre = "",
        $address = "",
        $fecha = "",
        $nota = "",
        $comentario = ""
    )
    {
        $this->token = $token;
        $this->tipo = $tipo;
        $this->usuario = $usuario;
        $this->propiedadNombre = $propiedadNombre;
        $this->address = $address;

        $this->fecha = $fecha;
        $this->nota = $nota;
        $this->comentario = $comentario;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('poncedennys2005071@gmail.com', 'S.M.LJZC'),
            subject: 'Notificacion Correo',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.mensaje',
        );
    }

    public function build()
    {
        try {
            //code...
            return $this->from(env('MAIL_FROM_ADDRESS', 'poncedennys2005071@gmail.com'))
                ->subject(env('MAIL_FROM_NAME', 'S.M.LJZC'))
                ->view('emails.mensaje')
                ->with(['mensaje' => 'Hola, esto es una notificacion importante']);
        } catch (\Throwable $th) {
            //throw $th;

            dd($th);
        }
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
