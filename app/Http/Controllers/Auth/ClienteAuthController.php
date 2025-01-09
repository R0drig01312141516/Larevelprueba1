<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class ClienteAuthController extends Controller
{

    /* Inicio de sesion */

    public function showLoginForm()
    {
        return view('auth.iniciar-sesion');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|exists:clientes,email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Por favor ingrese su correo electrónico.',
            'email.email' => 'Por favor ingrese un correo electrónico válido.',
            'email.exists' => 'El correo electrónico ingresado no existe.',
            'password.required' => 'Por favor ingrese su contraseña.',
        ]);

        // Obtener el usuario
        $usuario = Cliente::where('email', $request->email)->first();

        // Verificar si la contraseña es correcta
        if (!Hash::check($request->password, $usuario->password)) {
            return back()->withErrors([
                'password' => 'La contraseña ingresada es incorrecta.',
            ])->withInput();
        }

        // Intento de autenticación exitoso
        Auth::guard('cliente')->login($usuario);
        Cart::restore($usuario->id);
        Cart::store($usuario->id);

        return redirect()->route('inicio');
    }

    public function logout()
    {
        Auth::guard('cliente')->logout();
        Cart::destroy();
        return redirect()->route('inicio');
    }

    /* Registro de usuarios */

    public function showRegisterForm()
    {
        return view('auth.registrarse');
    }

    public function register(Request $request)
    {
        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Debes proporcionar un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];

        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255|unique:clientes',
            'password' => 'required|string|confirmed|min:8',
        ], $messages);

        // Creación del usuario
        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $cliente ?
            redirect()->route('cliente.login')->with('success', 'Usuario registrado exitosamente.') :
            back()->withErrors(['error' => 'Error al registrar el usuario.']);
    }
}
