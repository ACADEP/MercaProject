<?php

namespace App\Mailers;

use App\User;
use App\Sale;
use Carbon\Carbon;
use App\EnviaYa;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\MarketRates;

use Barryvdh\DomPDF\Facade as PDF;

class AppMailers {

    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * Who is the email from.
     */
    protected $from = 'sistemas@acadep.com';

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
        // Now deliver the email to the user.
        $this->deliverPassword();
    }

    public function sendEmailChangePassword(User $user) {
        // Send this to the users email.
        $this->to = $user->email;
        // Pass the view to this...
        $this->view = 'auth.changepassword';
        // The data that is required. 
        $this->data = compact('user');
        // Now deliver the email to the user.
        $this->deliver();
    }

    public function sendReceiptPayment(User $admin, User $client, $sale, $shiprate, $dateShip, $method_pay) {
        // Send this to the users email.
        $this->to = $admin->email;
        // Pass the view to this...
        $this->view = 'customer.partials.view-email';
        // The data that is required
        $this->data = compact('admin');
        if($sale!=null)
        {
            $this->deliverPDF("administración", $client, $sale);
        }else
        {
            $this->deliverPDF2("administración", $client, $shiprate, $dateShip, $method_pay);
        }
    }

    public function sendReceiptPaymentClient(User $client,$guia, $url, $img_carrie, $sale, $shiprate, $dateShip, $method_pay) {
       
        // Send this to the users email.
        $this->to = $client->email;
        // Pass the view to this...
        $this->view = 'customer.partials.view-email-client';
        // The data that is required
        $this->data = compact('client','guia','url','img_carrie');
      
        if($sale!=null)
        {
            $this->deliverPDF("cliente", $client, $sale);
        }
        else
        {
            $this->deliverPDF2("cliente", $client, $shiprate, $dateShip, $method_pay);
        }
        
    }
    public function sendOxxoReceipt(User $client, $pdf)
    {
        $this->to=$client->email;
        //Enviar a cliente
        $this->mailer->send("customer.partials.view-email-oxxo-payment", compact('client') , function($message) use($pdf){
            $message->from($this->from, 'Administrator')
            ->subject("Recibo para pagar en Oxxo")
            ->to($this->to)            
            ->attachData($pdf->output(), "Recibo-Oxxo.pdf");
        });
    }

    public function sendMarketRateReceipt(MarketRates $items)
    {
        $pdf = PDF::loadView('admin.market_rates.pdf-print',compact('items'));
        $this->to=$items->email;
        //Enviar a cliente
        $this->mailer->send("admin.market_rates.view-email", compact('client') , function($message) use($pdf, $items){
            $message->from($this->from, 'Administrator')
            ->subject("Cotización Mercadata")
            ->to($this->to)            
            ->attachData($pdf->output(), "Cotización-".$items->date.".pdf");
        });
    }

    public function sendReceiptClientAdmin(User $admin, User $client,$guia, $url, $img_carrie, $sale,$ship_rate, $ship_date)
    {
        $Items=$sale;
        $subtotal=$sale->total;
        $address=$client->address()->where("Activo",1)->first();
        $expiry = Carbon::now()->addDay(1); 
        $pdf = PDF::loadView('cart.Print-Receipt-webhook',compact('Items','subtotal','address','client','expiry','ship_rate', 'ship_date'));
       
        $this->to=$admin->email;
        //Enviar a administracion
        $this->mailer->send("customer.partials.view-email", compact('admin') , function($message) use($pdf){
            $message->from($this->from, 'Administrator')
            ->subject("Recibo de pago para envio")
            ->to($this->to)            
            ->attachData($pdf->output(), "Recibo-de-pago.pdf");
        });

        $this->to=$client->email;
         //Enviar a cliente
         $this->mailer->send("customer.partials.view-email-client", compact('client','guia','url','img_carrie') , function($message) use($pdf){
            $message->from($this->from, 'Administrator')
            ->subject("Recibo de compra")
            ->to($this->to)            
            ->attachData($pdf->output(), "Recibo-de-compra.pdf");
        });
        
       
    }

    /**
     * Delivery email to user.
     */
    public function deliver() {
        $this->mailer->send($this->view, $this->data, function($message) {
                $message->from($this->from, 'Administrator')
                ->subject($this->subject)->to($this->to);
        });    

    }

    public function deliverPassword() {
        $this->mailer->send($this->view, $this->data, function($message) {
                $message->from($this->from, 'Administrator')
                ->subject($this->subject)->to($this->to);
        });    

    }

    public function deliverPDF($user, User $client, $sale) 
    {

        $Items=$sale;
        $subtotal=$sale->total;
        $address=$client->address()->where("Activo",1)->first();
        $expiry = Carbon::now()->addDay(1); 
        $pdf = PDF::loadView('cart.Print-Receipt',compact('Items','subtotal','address','client','expiry'));

        $this->mailer->send($this->view, $this->data, function($message) use($pdf){
                $message->from($this->from, 'Administrator')
                ->subject($this->subject)
                ->to($this->to)            
                ->attachData($pdf->output(), "recibo de pago.pdf");
        });    

    }

    public function deliverPDF2($user, User $client, $shiprate, $dateship, $method_pay) {
        Session::put('progress', "Generando recibo para ".$user);
        Session::save();

        $ItemsCarts=$client->carts()->get();
        $subtotal=$client->total;
        $address=$client->address()->where("Activo",1)->first(); 
        $expiry = Carbon::now()->addDay(1); 
        $pdf = PDF::loadView('cart.Print-Receipt',compact('ItemsCarts','subtotal','address','client','expiry', 'shiprate', 'dateship','method_pay'));

        Session::put('progress', "Enviando correo a ".$user);
        Session::save();
        
        $this->mailer->send($this->view, $this->data, function($message) use($pdf){
                $message->from($this->from, 'Administrator')
                ->subject($this->subject)
                ->to($this->to)            
                ->attachData($pdf->output(), "recibo de pago.pdf");
        });    

    }

}