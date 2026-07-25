<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNotificationEmailUser extends Mailable
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
        $ticketId = $this->data['ticket_id'] ?? 'SYSTEMS';

        return $this->subject('Update Tiket Laporan #' . $ticketId)
            ->view('v3.mail.notification-email');
    }
}
