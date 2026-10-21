<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerThankYou extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank You for Your Order - Kathirazhagi Boutique',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.orders.thank_you',
        );
    }

    public function attachments(): array
    {
        $attachments = [];
        
        if ($this->order->payment_method === 'online' && !empty($this->order->payment_screenshot)) {
            $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromPath(public_path($this->order->payment_screenshot));
        }
        
        return $attachments;
    }
}
