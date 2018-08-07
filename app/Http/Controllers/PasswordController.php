<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

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

    protected $redirectTo = '/';

    /**
     * Create a new password controller instance.
     *
     * @return void
     *
    public function __construct()
    {
        $this->middleware('guest');
    }*/

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

    /*public function getEmai()
    {
        return view('auth.password')
        ->with('search','holi');
    }*/

}
