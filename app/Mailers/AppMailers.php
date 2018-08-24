<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailers {

    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * Who is the email from.
     */
    protected $from = 'jonces94@hotmail.com';

    /**
     * Who is this going to.
     */
    protected $to;

    /**
     * What view are we fetching.
     */
    protected $view;

    /**
     * What data are we passing through.
     */
    protected $data = [];

    /**
     * Asunto del correo.
     */
    protected $subject = 'Registro Mercadata';

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

    /**
     * Delivery email to user.
     */
    public function deliver() {
        $this->mailer->send($this->view, $this->data, function($message) {
                $message->from($this->from, 'Administrator')
                ->subject($this->subject)
                ->to($this->to);
                //dd($message);
        });    
    }

}