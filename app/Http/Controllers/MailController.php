<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function enviarMail(Request $req){
        
        $reglas = [
            "nombre" => "required|string|min:3|max:100",
            "mail" => "required|email",
            "consulta" => "required|string|min:3|max:100",
        ];

        $mensajes = [
            "required" => "El campo :attribute es obligatorio",
            "string" => "El campo :attribute debe ser texto",
            "alpha" => "El campo :attribute debe ser texto",
            "min" => "El campo :attribute debe tener al menos :min caractéres",
            "max" => "El campo :attribute no debe pasar los :max caractéres",
            "unique" => "El :attribute ingresado ya está en uso",
            "email" => "Ingrese un email valido",
            "regex" => "Ingrese un nombre valido",
        ];

        $validador = Validator::make($req->all(),$reglas,$mensajes);

        if($validador->fails()){
            return response()->json([
                "status"=>400,
                "errors"=>$validador->messages()
            ]);
        } else {
            $details = [
                'remitente' => $req["nombre"],
                'remitente-email' => $req["mail"],
                'consulta' => $req["consulta"],
            ];
    
            Mail::to("mijaelvolker17@gmail.com")->send(new TestMail($details));
    
            return response()->json([
                'status' => 200,
                'message' => "Consulta enviada",
            ]);
        }

        
    }
}
