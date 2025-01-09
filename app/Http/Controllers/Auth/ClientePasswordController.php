<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use App\Traits\AuthValidationMessages;
use App\Traits\HandlesPasswordReset;

class ClientePasswordController extends Controller
{
    use AuthValidationMessages, HandlesPasswordReset;

    protected $table = 'clientes';
    protected $broker = 'clientes';
    protected $loginRoute = 'cliente.login';

    public function showForgotPasswordForm()
    {
        return view('auth.email');
    }

    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('auth.reset')->with(['token' => $token, 'email' => $request->email]);
    }
}
