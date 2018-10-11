<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade as PDF;

class AppMailers {

    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * Who is the email from.
     */
    protected $from = 'confirmacion@mercageek.com';

    /**
     * Who is this going to.
     */
    protected $to;

    /**
     * What view are we fetching.
     */
    protected $view;

    protected $pathPDF;
    /**
     * What data are we passing through.
     */
    protected $data = [];

    /**
     * Asunto del correo.
     */
    protected $subject = 'Mercadata';

    /**
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    /**
     * Send the email confirmation to user.
     *
     * @param User $user
     */
    public function sendEmailConfirmationTo(User $user) {
        // Send this to the users email.
        $this->to = $user->email;
        // Pass the view to this...
        $this->view = 'auth.confirm';
        // The data that is required.
        $this->data = compact('user');
        // Now deliver the email to the user.
        $this->deliver();
    }

    public function sendEmailResetPassword(User $user) {
        // Send this to the users email.
        $this->to = $user->email;
        // Pass the view to this...
        $this->view = 'auth.confirmpassword';
        // The data that is required. 
        $this->data = compact('user');
        // Resetpassword
        $subjectresetpassword = 1;
        // Now deliver the email to the user.
        $this->deliver();
    }

    public function sendReceiptPayment(User $user) {
        // Send this to the users email.
        $this->to = $user->email;
        // Pass the view to this...
        $this->view = 'customer.partials.view-email';
        // The data that is required
        $this->data = compact('user');

        $this->deliverPDF();
    }

    public function sendReceiptPaymentClient(User $user) {
        // Send this to the users email.
        $this->to = $user->email;
        // Pass the view to this...
        $this->view = 'customer.partials.view-email-client';
        // The data that is required
        $this->data = compact('user');

        $this->deliverPDF();
    }

    /**
     * Delivery email to user.
     */
    public function deliver() {
       
        $this->mailer->send($this->view, $this->data, function($message) {
                $message->from($this->from, 'Administrator')
                ->subject($this->subject)
                ->to($this->to);
               
        });    

    }

    public function deliverPDF() {
        $cartItems=Auth::user()->carts()->get();
        $subtotal=Auth::user()->total;
        $address=Auth::user()->address()->where("Activo",1)->first(); 
        $pdf = PDF::loadView('customer.partials.recibe',compact('cartItems','subtotal','address'));
        $this->mailer->send($this->view, $this->data, function($message) use($pdf){
                $message->from($this->from, 'Administrator')
                ->subject($this->subject)
                ->to($this->to)            
                ->attachData($pdf->output(), "recibo de pago.pdf");
        });    

    }

}