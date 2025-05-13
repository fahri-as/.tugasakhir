<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Pelamar;
use App\Models\TesKemampuan;

class SkillTestFailed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The pelamar instance.
     *
     * @var \App\Models\Pelamar
     */
    public $pelamar;

    /**
     * The skill test instance.
     *
     * @var \App\Models\TesKemampuan
     */
    public $tesKemampuan;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Pelamar  $pelamar
     * @param  \App\Models\TesKemampuan  $tesKemampuan
     * @return void
     */
    public function __construct(Pelamar $pelamar, TesKemampuan $tesKemampuan)
    {
        $this->pelamar = $pelamar;
        $this->tesKemampuan = $tesKemampuan;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Hasil Tes Kemampuan - ' . $this->pelamar->job->nama_job,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.skill-test-failed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
