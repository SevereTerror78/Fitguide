<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public array $cart;
<<<<<<< HEAD
    public float $subtotal;
    public float $shipping;
    public float $total;
    public $order;

    public function __construct(array $cart, float $subtotal, float $shipping, float $total, $order)
=======

    // 💰 HUF értékek (int)
    public int $subtotal;
    public int $shipping;
    public int $total;

    public $order;

    public function __construct(array $cart, int $subtotal, int $shipping, int $total, $order)
>>>>>>> fc7673c (frontend update and some new feature)
    {
        $this->cart = $cart;
        $this->subtotal = $subtotal;
        $this->shipping = $shipping;
        $this->total = $total;
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
<<<<<<< HEAD
            subject: 'Order Placed',
=======
            subject: 'Your FitGuide order confirmation',
>>>>>>> fc7673c (frontend update and some new feature)
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_placed',
            with: [
<<<<<<< HEAD
                'cart' => $this->cart,
                'subtotal' => $this->subtotal,
                'shipping' => $this->shipping,
                'total' => $this->total,
                'order' => $this->order,
=======
                'cart'     => $this->cart,
                'subtotal' => $this->subtotal,
                'shipping' => $this->shipping,
                'total'    => $this->total,
                'order'    => $this->order,
>>>>>>> fc7673c (frontend update and some new feature)
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> fc7673c (frontend update and some new feature)
