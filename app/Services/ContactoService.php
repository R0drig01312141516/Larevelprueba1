<?php

namespace App\Services;

use App\Models\Contacto;
use App\Mail\ContactoMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ContactoService
{
    public function crearContacto(array $validatedData): Contacto
    {
        $contacto = Contacto::create($validatedData);
        $this->enviarNotificacionContacto($contacto);

        return $contacto;
    }

    public function enviarNotificacionContacto(Contacto $contacto): void
    {
        Mail::to(config('mail.mailers.smtp.username'))
            ->send(new ContactoMail($contacto));
    }

    public function verificarRecaptcha(string $recaptchaResponse, string $ip): bool
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $recaptchaResponse,
            'remoteip' => $ip
        ]);

        return $response->json()['success'] ?? false;
    }
}
