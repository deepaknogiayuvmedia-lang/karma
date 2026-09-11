<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeliveryOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $otp;

    public function __construct($order, $otp)
    {
        $this->order = $order;
        $this->otp = $otp;
    }

    public function build()
    {
        $companyName = \App\Model\BusinessSetting::where('type', 'company_name')->first()->value ?? config('app.name');

        return $this->subject('Delivery OTP for Order #' . $this->order->id)
                    ->view('email-templates.delivery-otp')
                    ->with([
                        'order' => $this->order,
                        'otp' => $this->otp,
                        'companyName' => $companyName,
                    ]);
    }
}
