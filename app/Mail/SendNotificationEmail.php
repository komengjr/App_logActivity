<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        // Mengambil nomor tiket dari array data (jika ada) untuk subjek yang dinamis
        $ticketId = $this->data['ticket_id'] ?? 'SYSTEM';

        return $this->subject('Update Tiket Bantuan #' . $ticketId . ' - ' . ($this->data['title'] ?? 'Notifikasi'))
            ->view('v3.mail.notification');
    }
}
