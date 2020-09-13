<?php

namespace App\Mails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReceiptToCustomer extends Mailable
{
    use SerializesModels;

    /**
     * Public Variables
     */
    public $payment;
    public $company;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
        $this->company = $payment->company;
        $this->customer = $payment->customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->replaceTags($this->company->getSetting('payment_mail_subject'));
        $mail_content = $this->replaceTags($this->company->getSetting('payment_mail_content'));

        return $this->subject($subject)
            ->view('emails.mails.payment_receipt_to_customer')
            ->with([ 
                'subject' => $subject, 
                'mail_content' => $mail_content
            ]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function replaceTags($text) {
        $payment_url = route('customer_portal.payments.details', ['customer' => $this->customer->uid, 'payment' => $this->payment->uid]);
        $tag_list = [
            '{company.name}' => $this->company->name,
            '{customer.display_name}' => $this->customer->display_name,
            '{customer.contact_name}' => $this->customer->display_name,
            '{customer.email}' => $this->customer->email,
            '{customer.phone}' => $this->customer->phone, 
            '{payment.number}' => $this->payment->payment_number,
            '{payment.link}' => '<a href="'. $payment_url .'">'. $payment_url .'</a>',
            '{payment.date}' => $this->payment->formatted_payment_date,
            '{payment.type}' => $this->payment->payment_method->name ?? '',
            '{payment.notes}' => $this->payment->notes,
            '{payment.amount}' => money($this->payment->amount, $this->payment->currency_code)->format(),
        ]; 
        foreach ($tag_list as $tag => $value) {
            $text = str_replace($tag, $value, $text);
        }
        return $text;
    }
}