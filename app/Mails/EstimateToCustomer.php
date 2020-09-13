<?php

namespace App\Mails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EstimateToCustomer extends Mailable
{
    use SerializesModels;

    /**
     * Public Variables
     */
    public $estimate;
    public $company;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($estimate)
    {
        $this->estimate = $estimate;
        $this->company = $estimate->company;
        $this->customer = $estimate->customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->replaceTags($this->company->getSetting('estimate_mail_subject'));
        $mail_content = $this->replaceTags($this->company->getSetting('estimate_mail_content'));

        return $this->subject($subject)
            ->view('emails.mails.estimate_to_customer')
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
        $estimate_url = route('customer_portal.estimates.details', ['customer' => $this->customer->uid, 'estimate' => $this->estimate->uid]);
        $tag_list = [
            '{company.name}' => $this->company->name,
            '{customer.display_name}' => $this->customer->display_name,
            '{customer.contact_name}' => $this->customer->display_name,
            '{customer.email}' => $this->customer->email,
            '{customer.phone}' => $this->customer->phone, 
            '{estimate.number}' => $this->estimate->estimate_number,
            '{estimate.link}' => '<a href="'. $estimate_url .'">'. $estimate_url .'</a>',
            '{estimate.date}' => $this->estimate->formatted_estimate_date,
            '{estimate.expiry_date}' => $this->estimate->formatted_expiry_date,
            '{estimate.reference}' => $this->estimate->reference_number,
            '{estimate.notes}' => $this->estimate->notes, 
            '{estimate.sub_total}' => money($this->estimate->sub_total, $this->estimate->currency_code)->format(),
            '{estimate.total}' => money($this->estimate->total, $this->estimate->currency_code)->format(),
        ];
        foreach ($tag_list as $tag => $value) {
            str_replace($tag, $value, $text);
        }
        return $text;
    }
}