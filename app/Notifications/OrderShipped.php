<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderShipped extends Notification
{
    use Queueable;

    protected $orderData;

    public function __construct($orderData)
    {
        $this->orderData = $orderData;
    }

    // Tentukan channel pengiriman (bisa buat channel custom 'whatsapp')
    public function via($notifiable)
    {
        return ['whatsapp'];
    }

    // Format data yang akan dikirim ke WhatsApp
    public function toWhatsApp($notifiable)
    {
        return "Halo " . $notifiable->name . ", pesanan #" . $this->orderData['id'] . " sedang dikirim!";
    }
}
