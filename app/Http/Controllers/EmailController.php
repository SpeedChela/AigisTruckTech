<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function form_enviar_correo()
    {
        return view("formulario_email");
    }

    public function enviar_correo(Request $request)
    {
        $destinatario = $request->input("destinatario");
        $asunto = $request->input("asunto");
        $contenido = $request->input("contenido_mail");

        $data = array('contenido' => $contenido);
        $r = Mail::send('plantilla_correo', $data, function ($message) use ($asunto, $destinatario) {
            $message->from(env('MAIL_FROM_ADDRESS'), 'Aigis Truck Tech');
            $message->to($destinatario)->subject($asunto);
        });

        if (!$r) {
            return view("plantillamensaje")
                ->with('var', '2')
                ->with('msj', 'Error al enviar el correo electrónico. Por favor, intente nuevamente.')
                ->with('ruta_boton', 'form_enviar_correo')
                ->with('mensaje_boton', 'Volver al Formulario');
        } else {
            return view("plantillamensaje")
                ->with('var', '1')
                ->with('msj', 'Correo enviado exitosamente a ' . $destinatario)
                ->with('ruta_boton', 'form_enviar_correo')
                ->with('mensaje_boton', 'Enviar Otro Correo');
        }
    }
} 