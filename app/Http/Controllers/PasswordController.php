<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Transformers\Json;
use App\Mailers\AppMailers;
use App\User;
use App\Http\Requests\RegistrationRequest;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    //use SendsPasswordResetEmails;

    protected $redirectTo = '/';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the Registration View.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmail() {
        return view('auth.password', compact('query', 'search'));
    }

    /**
     * Send a reset link to the given user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @return \Illuminate\Http\RedirectResponse
     * @return \Illuminate\Http\Response
     * 
     */
    public function postEmail(Request $request, AppMailers $mailer) {
        // Validate email.
        $this->validate($request, ['email'    => 'required|email']);
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $user->token = \Token::Random(30);
            $user->update();
            $mailer->sendEmailResetPassword($user);
            return back()->with('flash','Por favor, confirma tu correo electrónico en tu bandeja de entrada.');
        } else {
            return back()->with('flash','El correo ingresado no es correcto ingrese un correo nuevamente');
        }
    }

    public function getReset($remember_token) {
        // Get the user with token, or fail.
        User::whereToken($remember_token)->firstOrFail()->confirmEmail();
        $token = $remember_token;
        return view('auth.reset', compact('token'));
    }

    public function postReset(Request $request, AppMailers $mailer) {
        $this->validate($request, ['email'    => 'required|email']);
        $user = User::where('email', $request->input('email'))->first();
        $user->password = bcrypt($request->input('password'));
        $user->update();
        $mailer->sendEmailChangePassword($user);
        return redirect('/login');
    }

}
