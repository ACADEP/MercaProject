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
        // Gets the query string from our form submission
        $query = Input::get('search');

        // Returns an array of products that have the query string located somewhere within
        // our products product name. Paginates them so we can break up lots of search results.
        $search = \DB::table('products')->where('product_name', 'LIKE', '%' . $query . '%')->paginate(10);

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
        $mailer->sendEmailResetPassword($user);
        return redirect('/')->with('flash','Ahora revise su correo electronico gracias.');
    }

    public function postReset() {
        // Gets the query string from our form submission
        $query = Input::get('search');

        // Returns an array of products that have the query string located somewhere within
        // our products product name. Paginates them so we can break up lots of search results.
        $search = \DB::table('products')->where('product_name', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('auth.password/reset', compact('query', 'search'));
    }

}
