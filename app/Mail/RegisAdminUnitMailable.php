<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisAdminUnitMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(private $name, private $unit_name)
    {
        //
    }

    public function build(){
        return $this->from('sistempeminjamanbarang@gmail.com')
                    ->view('admin.mail.approveAdminUnit')
                    ->with([
                        'name' => $this->name, 
                        'unit_name' => $this->unit_name
                    ]);
    }

    /**
     * Get the message envelope
     * 
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('sistempeminjamanbarang@gmail.com', 'Sistem Peminjaman Barang UNS'),
            subject: 'Registrasi Akun Admin Unit Telah Disetujui!',
        );
    }

    /**
     * Get the message content definition.
     * 
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.mail.approveAdminUnit',
            with: ['name' => $this->name, 'unit_name' => $this->unit_name],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
