<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\MoonShine\Forms\ResetPasswordForm;
use App\MoonShine\Forms\ForgotPasswordForm;
use Illuminate\Support\Facades\Password;
use App\Traits\AuthValidationMessages;
use App\Traits\HandlesPasswordReset;

class AdminPasswordController extends Controller
{
    use AuthValidationMessages, HandlesPasswordReset;

    protected $table = 'moonshine_users';
    protected $broker = 'moonshine_users';
    protected $loginRoute = 'moonshine.login';

    public function showForgotPasswordForm()
    {
        return view('moonshine::auth.forgot-password', [
            'form' => new ForgotPasswordForm()
        ]);
    }

    public function showResetPasswordForm(Request $request)
    {
        return view('moonshine::auth.reset-password', [
            'form' => new ResetPasswordForm(),
        ]);
    }
}
