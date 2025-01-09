<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Services\ContactoService;
use App\Services\RecaptchaService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContactoRequest;
use App\Actions\Contacto\CrearContactoAction;

class ContactoController extends Controller
{
    private $contactoService;

    public function __construct(ContactoService $contactoService)
    {
        $this->contactoService = $contactoService;
    }

    public function index(): View
    {
        return view('pages.nosotros');
    }

    public function store(ContactoRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $captchaVerificado = $this->contactoService->verificarRecaptcha(
            $validatedData['g-recaptcha-response'],
            $request->ip()
        );

        if (!$captchaVerificado) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['g-recaptcha-response' => 'Por favor, verifica que no eres un robot.']);
        }

        unset($validatedData['g-recaptcha-response']);

        if ($this->contactoService->crearContacto($validatedData)) {
            return redirect()->back()->with('success', 'Mensaje enviado exitosamente');
        }

        return redirect()->back()->with('error', 'Error al enviar el mensaje');
    }
}
