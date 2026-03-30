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
=======
    public int $subtotal;
    public int $shipping;
    public int $total;
    public $order;

    public function __construct(array $cart, int $subtotal, int $shipping, int $total, $order)
>>>>>>> 5c55d34 (new features)
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
<<<<<<< HEAD
            subject: 'Order Placed',
=======
            subject: 'Your FitGuide order confirmation',
>>>>>>> fc7673c (frontend update and some new feature)
=======
            subject: __('emails.order.subject'),
>>>>>>> 5c55d34 (new features)
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_placed',
            with: [
<<<<<<< HEAD
<<<<<<< HEAD
                'cart' => $this->cart,
                'subtotal' => $this->subtotal,
                'shipping' => $this->shipping,
                'total' => $this->total,
                'order' => $this->order,
=======
=======
>>>>>>> 5c55d34 (new features)
                'cart'     => $this->cart,
                'subtotal' => $this->subtotal,
                'shipping' => $this->shipping,
                'total'    => $this->total,
                'order'    => $this->order,
<<<<<<< HEAD
>>>>>>> fc7673c (frontend update and some new feature)
=======
>>>>>>> 5c55d34 (new features)
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
<<<<<<< HEAD
<<<<<<< HEAD
}
=======
}
>>>>>>> fc7673c (frontend update and some new feature)
=======
}
>>>>>>> 5c55d34 (new features)
